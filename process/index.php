<?php

require_once __DIR__ . "/Utils.php";
require_once __DIR__ . "/../vendor/autoload.php";
use Symfony\Component\DomCrawler\Crawler;
header('Content-type:text/json');

$result = file_get_contents("php://input") ;
$result = json_decode($result);

if(isset($result->token)){
    $token = $result->token;
    if($token == "6d71a043735ea665dad7af741bb966e3" || $token == "c4ba02f6720494f38c91f28d675a278d"){
        $searchText = substr($result->text,2);;
        $url = "https://www.sogou.com/web?query=$searchText&ie=utf8&num=10";
        $response = Go($url);
        $crawler = new Crawler();
        $crawler->addHtmlContent($response);
        //解析html数据
        try {
            $data = []; //结构化数据存本数组
            $res = "您查询的关键词是：$searchText\n";
            $index = 0;
            $baseUrl="https://www.sogou.com";
            $crawler->filter('.pt a')->each(function ($node, $i) {
                global $res, $index, $baseUrl;
                if($node->text() !== "" && $node->text() !== " "){
                    $index++;
                    $res = $res . "[$index. " . trim($node->text()) . "]($baseUrl" . $node->attr("href") . ")\n";
                }
            });
            $crawler->filter('.vrTitle a')->each(function ($node, $i) {
                global $res, $index, $baseUrl;
                global $res, $index, $baseUrl;
                if($node->text() !== "" && $node->text() !== " "){
                    $index++;
                    $res = $res . "[$index. " . trim($node->text()) . "]($baseUrl" . $node->attr("href") . ")\n";
                }
            });
            echo Utils::jsonResponse($res);
        }catch (\Exception $e) {
            echo "机器人正在休息中，请稍后查询。";
        }
    }
}

function Go( $url )
{
    $header = array (
        "Host:www.sogou.com",
        "Content-Type:application/x-www-form-urlencoded",//post请求
        "Connection: keep-alive",
        'Referer:http://www.baidu.com',
        'User-Agent: Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; BIDUBrowser 2.6)'
    );
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,$header);
    $content = curl_exec($ch);
    curl_close ( $ch );
    return $content ;
}




