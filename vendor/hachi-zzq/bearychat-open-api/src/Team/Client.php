<?php

namespace Hachi\Bearychat\Team;

use Hachi\Bearychat\Kernel\BaseClient;

class Client extends BaseClient
{
    const INFO = 'team.info';

    /**
     * 返回当前团队信息.
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function info()
    {
        return $this->httpGet(self::INFO);
    }
}
