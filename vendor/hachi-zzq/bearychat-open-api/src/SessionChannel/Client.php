<?php

namespace Hachi\Bearychat\SessionChannel;

use Hachi\Bearychat\Kernel\BaseClient;

class Client extends BaseClient
{
    const ARCHIVE = 'session_channel.archive';

    const CONVERT_TO_CHANNEL = 'session_channel.convert_to_channel';

    const CREATE = 'session_channel.create';

    const INFO = 'session_channel.info';

    const INVITE = 'session_channel.invite';

    const KICK = 'session_channel.kick';

    const KICKOUT = 'session_channel.kickout';

    const LEAVE = 'session_channel.leave';

    const LIST = 'session_channel.invite';

    /**
     * 归档一个临时讨论组.
     *
     * @param $sessionChannelId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function archive($sessionChannelId)
    {
        return $this->httpPostJson(self::ARCHIVE, ['session_channel_id' => $sessionChannelId]);
    }

    /**
     * 将临时讨论组转换为讨论组.
     *
     * @param $sessionChannelId
     * @param $name
     * @param bool $private
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function convertToChannel($sessionChannelId, $name, $private = false)
    {
        return $this->httpPostJson(self::CONVERT_TO_CHANNEL, [
            'session_channel_id' => $sessionChannelId,
            'name' => $name,
            'private' => $private,
        ]);
    }

    /**
     * 创建一个临时讨论组.
     *
     * @param string $name
     * @param $memberUids
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function create($memberUids, $name = '')
    {
        $params = [];
        if ($name) {
            $params['name'] = $name;
        }
        $params['member_uids'] = $memberUids;

        return $this->httpPostJson(self::CONVERT_TO_CHANNEL, $params);
    }

    /**
     * 返回一个临时讨论组的完整信息.
     *
     * @param $sessionChannelId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function info($sessionChannelId)
    {
        return $this->httpGet(self::INFO, ['session_channel_id' => $sessionChannelId]);
    }

    /**
     * 邀请一个团队成员加入临时讨论组.
     *
     * @param $sessionChannelId
     * @param $uid
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function invite($sessionChannelId, $uid)
    {
        return $this->httpPostJson(self::INVITE, ['session_channel_id' => $sessionChannelId, 'invite_uid' => $uid]);
    }

    /**
     * 移除一个临时讨论组成员.
     *
     * @param $sessionChannelId
     * @param $uid
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function kick($sessionChannelId, $uid)
    {
        return $this->httpPostJson(self::KICK, ['session_channel_id' => $sessionChannelId, 'kick_uid' => $uid]);
    }

    /**
     * 移除一个临时讨论组成员.
     *
     * @param $sessionChannelId
     * @param $uid
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function kickout($sessionChannelId, $uid)
    {
        return $this->httpPostJson(self::KICKOUT, ['session_channel_id' => $sessionChannelId, 'kick_uid' => $uid]);
    }

    /**
     * 离开临时讨论组.
     *
     * @param $sessionChannelId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function leave($sessionChannelId)
    {
        return $this->httpPostJson(self::LEAVE, ['session_channel_id' => $sessionChannelId]);
    }

    /**
     * 返回团队内已经加入的临时讨论组列表.
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
