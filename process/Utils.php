<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/28
 * Time: 17:42
 */

class Utils{
    public static function jsonResponse($res){
        return json_encode(array("text" => $res));
    }
}