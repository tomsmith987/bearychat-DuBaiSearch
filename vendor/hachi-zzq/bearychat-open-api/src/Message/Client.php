<?php

namespace Hachi\Bearychat\Message;

use Hachi\Bearychat\Kernel\BaseClient;

class Client extends BaseClient
{
    const CREATE = 'message.create';

    const DELETE = 'message.delete';

    const INFO = 'message.info';

    const QUERY = 'message.query';

    const UPDATE_TEXT = 'message.update_text';

    /**
     * 发送一条消息到指定聊天会话.
     *
     * @param $vchannelId
     * @param $text
     * @param array $attachments
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function create($input)
    {
        return $this->httpPostJson(self::CREATE, $input);
    }

    /**
     * 删除一条消息.
     *
     * @param $vchannelId
     * @param $messageKey
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function delete($vchannelId, $messageKey)
    {
        return $this->httpPostJson(self::DELETE, [
            'vchannel_id' => $vchannelId,
            'message_key' => $messageKey,
        ]);
    }

    /**
     * 返回一条消息的信息.
     *
     * @param $vchannelId
     * @param $messageKey
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function info($vchannelId, $messageKey)
    {
        return $this->httpPostJson(self::INFO, [
            'vchannel_id' => $vchannelId,
            'message_key' => $messageKey,
        ]);
    }

    /**
     * 更新一条消息的内容.
     *
     * @param $vchannelId
     * @param $query
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function query($vchannelId, $query)
    {
        return $this->httpPostJson(self::QUERY, [
            'vchannel_id' => $vchannelId,
            'query' => $query,
        ]);
    }

    /**
     * 更新一条消息的内容.
     *
     * @param $vchannelId
     * @param $messageKey
     * @param $text
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function updateText($vchannelId, $messageKey, $text)
    {
        return $this->httpPatchJson(self::UPDATE_TEXT, [
            'vchannel_id' => $vchannelId,
            'message_key' => $messageKey,
            'text' => $text,
        ]);
    }
}
