<?php
/**
 * this is a demo
 * DateTime: 2018/7/12 16:05
 * Author: Zhengqian.zhu <zhuzhengqian@vchangyi.com>.
 */
require 'vendor/autoload.php';

$application = new \Hachi\Bearychat\Application([
    'token' => 'demo-token',
]);

/**
 * 频道列表.
 */
$channels = $application->channel->list();

/**
 * 发送消息.
 */
$message = $application->message->create([
    'title' => '这个发送消息的内容',
    'attachments' => [
        [
            'text' => '附件的标题',
            'image' => [
                [
                    'url' => 'http://image.url.com',
                ],
            ],
        ],
    ],
]);

/**
 * 用户信息.
 */
$me = $application->user->me();
$user = $application->user->list();

/**
 * 会员信息.
 */
$session = $application->session_channel->list();
$session = $application->session_channel->create(['=bw52O', '=bw52P'], '这个是讨论组名称');
