<?php

namespace Hachi\Bearychat\VChannel;

use Hachi\Bearychat\Kernel\BaseClient;

class Client extends BaseClient
{
    const INFO = 'user.info';

    const LIST = 'user.list';

    const ME = 'user.me';

    const UPDATE_ME = 'user.update_me';

    /**
     * 返回团队内指定用户完整信息.
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
     * 返回团队内的用户列表.
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function list()
    {
        return $this->httpGet(self::LIST);
    }

    /**
     * 返回当前用户的信息.
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function me()
    {
        return $this->httpGet(self::ME);
    }

    /**
     * 更新当前用户信息.
     *
     * @param $name
     * @param $fullName
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author Caikeal<caikeal@qq.com>
     */
    public function updateMe($name, $fullName)
    {
        return $this->httpGet(self::UPDATE_ME, ['name' => $name, 'full_name' => $fullName]);
    }
}
