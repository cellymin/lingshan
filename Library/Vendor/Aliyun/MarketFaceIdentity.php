<?php
/**
 * Created by PhpStorm.
 * User: lindada
 * Date: 2018/9/13
 * Time: 上午9:32
 */

include_once __DIR__.'/ALiYunBasics.php';
class MarketFaceIdentity extends  ALiYunBasics
{

    public static $idCardNum;
    public static $realName;
    public static function requestParameter(){
        $request = array();
        $request['idCardNum'] = self::$idCardNum;
        $request['realName'] = self::$realName;
        $request['image'] = self::$file_base64;
        self::$body = json_encode($request);

    }
    public static function request(){
        self::fileBase64();
        self::headers();
        self::requestParameter();
        self::curl();
    }
}