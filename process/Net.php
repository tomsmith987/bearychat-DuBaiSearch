<?php
//require_once "Token.php";
class Net
{
//    public static function post_code($postUrl, $curlPost = [])
//    {
//        try {
//            $ch = curl_init();//初始化curl
//            $tmpfname = dirname(__FILE__).'/cookie.txt';
//            curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfname);
//            curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfname);
//            curl_setopt($ch, CURLOPT_VERBOSE, true);
//            curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
//            curl_setopt($ch, CURLOPT_HEADER, false);//设置header
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
//            curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Accept:application/json',
//                    "Content-Type:application/json;charset=utf-8")
//            );
//            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
//            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//            $data = curl_exec($ch);//运行curl
//            $data = json_decode($data,true);
//            return $data;
//
//        } catch (Exception $e) {
//            return null;
//        }
//    }
//    public static function post_token($postUrl, $curlPost = []){
//
//
//        try {
//
//
//            $ch = curl_init();//初始化curl
//            $tmpfname = dirname(__FILE__).'/cookie.txt';
//            curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfname);
//            curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfname);
//            curl_setopt($ch, CURLOPT_VERBOSE, true);
//            curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
//            curl_setopt($ch, CURLOPT_HEADER, false);//设置header
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
//            curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
//
//
//            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
//            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
//            //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//            //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//
//
//            $data = curl_exec($ch);//运行curl
//            $data = json_decode($data,true);
//            return $data;
//
//        } catch (Exception $e) {
//            return null;
//        }
//
//    }
//
//    public static function addData($url, $requestParam = [], $postJson = true, $resultIsJson = true, $resultNeedDecode = false){
//        try {
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5);//5秒超时
//            $httpHeader = [];
//            $token = Token::getToken();  //直接从数据库中获取Token
//            //echo $token . "</br>";
//            $httpHeader[] = "Content-Type:application/json";
//            $httpHeader[] = 'Authorization:Bearer ' . $token;
//            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestParam));
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
//            $resultJson = curl_exec($ch);
//            $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
//            curl_close($ch);
////            if ($resultJson) {
////                if ($resultNeedDecode) {
////                    $result = json_decode($resultJson, true);
////                    // todo 如果解析失败了 说明可能是后台在报错 把信息暴露出来 正式环境屏蔽
////                    if (!$result) {
////                        $result = $resultJson;
////                    }
////                }
////            }
//            if($httpCode == 201){
//                return $httpCode;
//            }else{
//                return null;
//            }
//        } catch (Exception $e) {
//            return null;
//        }
//    }
//    public static function changeData($url, $requestParam = [], $postJson = true, $resultIsJson = true, $resultNeedDecode = false){
//        try {
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5);//5秒超时
//            $httpHeader = [];
//            $token = Token::getToken();  //直接从数据库中获取Token
//            //echo $token . "</br>";
//            $httpHeader[] = "Content-Type:application/json";
//            $httpHeader[] = 'Authorization:Bearer ' . $token;
//            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestParam));
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
//            $resultJson = curl_exec($ch);
//            $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
//
//            curl_close($ch);
//            if($httpCode == 200){
//                return $httpCode;
//            }else{
//                return null;
//            }
////            $result = $resultJson;
////            if($httpCode == 200){
////                if ($resultJson) {
////                    if ($resultNeedDecode) {
////                        $result = json_decode($resultJson, true);
////                        // todo 如果解析失败了 说明可能是后台在报错 把信息暴露出来 正式环境屏蔽
////                        if (!$result) {
////                            $result = $resultJson;
////                        }
////                    }
////                }
////            }else{
////                $result = "changeDataError";
////            }
////            return $result;
//        } catch (Exception $e) {
//            return null;
//        }
//    }
//
//
//    //发送post请求
//    public static function post_zhixiao($url, $requestParam = [], $postJson = true, $resultIsJson = true, $resultNeedDecode = false)
//    {
//        try {
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_HEADER, 1);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5);//5秒超时
//
//            $httpHeader = [];
//            //$httpHeader[] = "charset=utf-8";
//
//
//                //$httpHeader[] = "Accept:application/json";
//                $httpHeader[] = "Content-Type:application/json";
//
//
//
//                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestParam));
//
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
//
//            $resultJson = curl_exec($ch);
//            //print_r( curl_getinfo($ch) );
//            curl_close($ch);
//
//            $result = $resultJson;
//            if ($resultJson) {
//                if ($resultNeedDecode) {
//                    $result = json_decode($resultJson, true);
//                    // todo 如果解析失败了 说明可能是后台在报错 把信息暴露出来 正式环境屏蔽
//                    if (!$result) {
//                        $result = $resultJson;
//                    }
//                }
//            }
//            return $result;
//        } catch (Exception $e) {
//            return null;
//        }
//    }
//
//    //发送get请求
//    public static function get_zhixiao($url,$json = true)
//    {
//        try {
//            $token = Token::getToken();  //直接从数据库中获取Token
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5);//5秒超时
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer ' . $token));
//            $resultJson = curl_exec($ch);
//            curl_close($ch);
//
//            if ($json) {
//                $result = json_decode($resultJson, true);
//            } else {
//                $result = $resultJson;
//            }
//            return $result;
//        } catch (Exception $e) {
//            return null;
//        }
//    }
    //发送post请求
    public static function post($url, $requestParam = [], $postJson = true, $resultIsJson = true, $resultNeedDecode = false)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);//5秒超时

            $httpHeader = [];
            $httpHeader[] = "charset=utf-8";

            if ($postJson) {
                $httpHeader[] = "Content-Type:application/json";
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestParam, JSON_UNESCAPED_UNICODE));
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestParam));
            }

            if ($resultIsJson) {
                $httpHeader[] = "Accept:application/json";
            }

            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);

            $resultJson = curl_exec($ch);
            curl_close($ch);

            $result = $resultJson;
            if ($resultJson) {
                if ($resultNeedDecode) {
                    $result = json_decode($resultJson, true);
                    // todo 如果解析失败了 说明可能是后台在报错 把信息暴露出来 正式环境屏蔽
                    if (!$result) {
                        $result = $resultJson;
                    }
                }
            }
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }

    //发送get请求
    public static function get($url, $json = true)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);//5秒超时
            $resultJson = curl_exec($ch);
            curl_close($ch);

            if ($json) {
                $result = json_decode($resultJson, true);
            } else {
                $result = $resultJson;
            }
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }

}