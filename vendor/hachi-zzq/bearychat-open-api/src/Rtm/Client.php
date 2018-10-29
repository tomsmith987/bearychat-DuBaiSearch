<?php

namespace Hachi\Bearychat\Rtm;

use Hachi\Bearychat\Kernel\BaseClient;

class Client extends BaseClient
{
    const START = 'rtm.start';

    /**
     * 打开 RTM 连接会话.
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function start()
    {
        return $this->httpPostJson(self::START);
    }
}
