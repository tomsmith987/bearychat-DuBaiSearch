# bearychat open api PHP SDK 工具包

> zhuzhengqian<hachi.zzq@gmail.com> , Caikeal<caikeal@qq.com>


## 这个包是什么？

基于 [EasyWeChat](https://github.com/overtrue/wechat) 脚手架开发的 bearychat（贝洽） Open API PHP SDK

> https://github.com/bearyinnovative/OpenAPI


## 如何安装

### composer 引入

```$shell

composer require hachi-zzq/bearychat-open-api

```

## 使用示例
```php
<?php

$application = new \Hachi\Bearychat\Application([
    'token' => 'demo-token'
]);


/**
 * 频道列表
 */
$channels = $application->channel->list();


/**
 * 发送消息
 */
$message = $application->message->create([
    'title'       => '这个发送消息的内容',
    'attachments' => [
        [
            'text'  => '附件的标题',
            'image' => [
                [
                    'url' => 'http://image.url.com'
                ]
            ]
        ]
    ]
]);


/**
 * 用户信息
 */
$me = $application->user->me();
$user = $application->user->list();


/**
 * 会话
 */
$session = $application->session_channel->list();
$session = $application->session_channel->create(["=bw52O", "=bw52P"], '这个是讨论组名称');

```
