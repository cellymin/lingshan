<?php
/**
 * Created by PhpStorm.
 * User: lindada
 * Date: 2018/9/14
 * Time: 下午7:51
 */
include_once __DIR__.'/ALiYunBasics.php';
class MarketFaceCompare extends ALiYunBasics
{
    public static $file2_base64;
    public static $file2Path;
    public static function requestParameter(){
        $request = array();
        $request['type'] = 1;
        $request['content_1'] = self::$file_base64;
        $request['image_url_1'] = '';
        $request['content_2'] = self::$file2_base64;
        $request['image_url_2'] = '';
        self::$body = json_encode($request);

    }
    public static function file2Base64(){
        $binary = file_get_contents(self::$file2Path); // 文件读取
        self::$file2_base64 = base64_encode($binary); // 转码
    }
    public static function request(){
        self::fileBase64();
        self::file2Base64();
        self::headers();
        self::requestParameter();
        self::curl();
    }
}