<?php

namespace Hachi\Bearychat\Meta;

use Hachi\Bearychat\Kernel\BaseClient;

class Client extends BaseClient
{
    const META = 'meta';

    /**
     * 返回 BearyChat API 的状态
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function meta()
    {
        return $this->httpGet(self::META);
    }
}
