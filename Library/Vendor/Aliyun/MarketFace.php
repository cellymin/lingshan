<?php
/**
 * Created by PhpStorm.
 * User: lindada
 * Date: 2018/9/13
 * Time: 下午3:55
 */
include_once __DIR__.'/ALiYunBasics.php';
class MarketFace extends ALiYunBasics
{
    public static $type = 1;
    public static function request(){
        self::headers();
        self::requestParameter();
        self::curl();
    }
    public static function requestParameter(){
        $request = array();
        if(self::$type){
            self::fileBase64();
            $request['type'] = 1;
            $request['image_url'] = '';
            $request['content'] = self::$file_base64;;
        }else{
            $request['type'] = 0;
            $request['image_url'] = self::$filePath;
            $request['content'] = '';
        }
        self::$body = json_encode($request);
    }
}