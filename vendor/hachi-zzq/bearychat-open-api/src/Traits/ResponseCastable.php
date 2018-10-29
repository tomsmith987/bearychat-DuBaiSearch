<?php

namespace Hachi\Bearychat\Traits;

use Hachi\Bearychat\Kernel\Contracts\Arrayable;
use InvalidArgumentException;
use Hachi\Bearychat\Kernel\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Hachi\Bearychat\Kernel\Support\Collection;

trait ResponseCastable
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string|null                         $type
     *
     * @return \EasyWeChat\Kernel\Http\Response|ResponseInterface
     */
    protected function castResponseToType(ResponseInterface $response, $type = null)
    {
        $response = Response::buildFromPsrResponse($response);
        $response->getBody()->rewind();

        switch ($type ?? 'array') {
        case 'collection':
            return $response->toCollection();
        case 'array':
            return $response->toArray();
        case 'object':
            return $response->toObject();
        case 'raw':
            return $response;
        default:
            if (!is_subclass_of($type, Arrayable::class)) {
                throw new InvalidArgumentException(
                    sprintf(
                        'Config key "response_type" classname must be an instanceof %s',
                        Arrayable::class
                    )
                );
            }

            return new $type($response);
        }
    }

    /**
     * @param mixed       $response
     * @param string|null $type
     *
     * @return \EasyWeChat\Kernel\Http\Response|ResponseInterface
     */
    protected function detectAndCastResponseToType($response, $type = null)
    {
        switch (true) {
        case $response instanceof ResponseInterface:
            $response = Response::buildFromPsrResponse($response);

            break;
        case ($response instanceof Collection) || is_array($response) || is_object($response):
            $response = new Response(200, [], json_encode($response));

            break;
        case is_scalar($response):
            $response = new Response(200, [], $response);

            break;
        default:
            throw new InvalidArgumentException(sprintf('Unsupported response type "%s"', gettype($response)));
        }

        return $this->castResponseToType($response, $type);
    }
}
