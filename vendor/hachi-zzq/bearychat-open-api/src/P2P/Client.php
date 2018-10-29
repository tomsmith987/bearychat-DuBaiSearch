<?php

namespace Hachi\Bearychat\P2P;

use Hachi\Bearychat\Kernel\BaseClient;

class Client extends BaseClient
{
    const CREATE = 'p2p.create';

    const INFO = 'p2p.info';

    const LIST = 'p2p.list';

    /**
     * 创建一个 P2P 聊天会话.
     *
     * @param $userId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function create($userId)
    {
        return $this->httpPostJson(self::CREATE, ['user_id' => $userId]);
    }

    /**
     * 返回一个 P2P 聊天会话的完整信息.
     *
     * @param $channelId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function info($channelId)
    {
        return $this->httpGet(self::INFO, ['p2p_channel_id' => $channelId]);
    }

    /**
     * 返回 P2P 聊天会话列表.
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function list()
    {
        return $this->httpGet(self::LIST);
    }
}
