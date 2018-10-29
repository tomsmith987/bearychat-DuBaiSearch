<?php

namespace Hachi\Bearychat\User;

use Hachi\Bearychat\Kernel\BaseClient;

class Client extends BaseClient
{
    const INFO = 'user.info';

    const LIST = 'user.list';

    const ME = 'user.me';

    /**
     * 用户列表.
     *
     * @param array $input
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     *
     * @author zhuzhengqian <hachi.zzq@gmail.com>
     */
    public function list(array $input = [])
    {
        return $this->httpGet(self::LIST, $input);
    }

    /**
     * 返回指定聊天会话的完整信息.
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function info($userId)
    {
        return $this->httpGet(self::INFO, ['user_id' => $userId]);
    }

    /**
     * 个人信息.
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     *
     * @author zhuzhengqian <hachi.zzq@gmail.com>
     */
    public function me()
    {
        return $this->httpGet(self::ME);
    }
}
