<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Hachi\Bearychat\Kernel;

use GuzzleHttp\Client;
use Hachi\Bearychat\Kernel\Exceptions\BearychatRequestFulFilledException;
use Hachi\Bearychat\Kernel\Exceptions\BearychatRequestRejectException;
use Hachi\Bearychat\Kernel\Http\Response;
use Psr\Http\Message\RequestInterface;
use Hachi\Bearychat\Traits\HasHttpRequests;
use Hachi\Bearychat\Kernel\Contracts\SignInterface;

/**
 * Class BaseClient.
 *
 * @author overtrue <i@overtrue.me>
 */
class BaseClient
{
    use HasHttpRequests {
        request as performRequest;
    }

    protected $app;

    protected $sign;

    /**
     * @var
     */
    protected $baseUri = 'https://api.bearychat.com/v1/';

    /**
     * BaseClient constructor.
     */
    public function __construct(ServiceContainer $app, SignInterface $sign = null)
    {
        $this->app = $app;
        $this->sign = $sign ?? $this->app['sign'];
    }

    /**
     * GET request.
     *
     * @param string $url
     * @param array  $query
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function httpGet(string $url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query]);
    }

    public function httpFileGet(string $url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query], true);
    }

    /**
     * POST request.
     *
     * @param string $url
     * @param array  $data
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function httpPost(string $url, array $data = [])
    {
        return $this->request($url, 'POST', ['form_params' => $data]);
    }

    /**
     * JSON request.
     *
     * @param string       $url
     * @param string|array $data
     * @param array        $query
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function httpPostJson(string $url, array $data = [], array $query = [])
    {
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
    }

    /**
     * PATCH request.
     *
     * @param string $url
     * @param array  $data
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function httpPatch(string $url, array $data = [])
    {
        return $this->request($url, 'PATCH', ['form_params' => $data]);
    }

    public function httpPatchJson(string $url, array $data = [])
    {
        return $this->request($url, 'PATCH', ['json' => $data]);
    }

    /**
     * Upload file.
     *
     * @param string $url
     * @param array  $files
     * @param array  $form
     * @param array  $query
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyWeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function httpUpload(string $url, array $files = [], array $form = [], array $query = [])
    {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name' => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        return $this->request($url, 'POST', ['query' => $query, 'multipart' => $multipart]);
    }

    public function getSign(): SignInterface
    {
        return $this->sign;
    }

    public function setSign(SignInterface $sign)
    {
        $this->sign = $sign;

        return $this;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array  $options
     * @param bool   $returnRaw
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false)
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }

        $response = $this->performRequest($url, $method, $options);

        return $returnRaw ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
    }

    /**
     * @param string $url
     * @param string $method
     * @param array  $options
     *
     * @return \EasyWeChat\Kernel\Http\Response
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function requestRaw(string $url, string $method = 'GET', array $options = [])
    {
        return Response::buildFromPsrResponse($this->request($url, $method, $options, true));
    }

    /**
     * Return GuzzleHttp\Client instance.
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient(): Client
    {
        if (!($this->httpClient instanceof Client)) {
            $this->httpClient = $this->app['http_client'] ?? new Client();
        }

        return $this->httpClient;
    }

    /**
     * Register Guzzle middlewares.
     */
    protected function registerHttpMiddlewares()
    {
        // access token
        $this->pushMiddleware($this->headerSingMiddleware(), 'sign');
        //error handle
        $this->pushMiddleware($this->customErrorsHandle(), 'custom_error');
    }

    /**
     * Attache access token to request query.
     *
     * @return \Closure
     */
    protected function headerSingMiddleware()
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                if ($this->sign) {
                    $request = $this->sign->applyToRequest($request, $options);
                }

                return $handler($request, $options);
            };
        };
    }

    /**
     * Middleware that throws exceptions for 4xx or 5xx responses when the
     * "http_error" request option is set to true.
     *
     * @return callable returns a function that accepts the next handler
     */
    protected function customErrorsHandle()
    {
        return function (callable $handler) {
            return function ($request, array $options) use ($handler) {
                if (empty($options['http_errors'])) {
                    return $handler($request, $options);
                }

                return $handler($request, $options)->then(
                    function (\GuzzleHttp\Psr7\Response $response) use ($request, $handler) {
                        $content = json_decode($response->getBody()->getContents(), true);
                        if (isset($content['code'])) {
                            throw new BearychatRequestFulFilledException($content['error'] ?? '', $content['code']);
                        }

                        return $response;
                    },
                    function(\Exception $exception){
                        throw new BearychatRequestRejectException($exception->getMessage());
                    }
                );
            };
        };
    }
}
