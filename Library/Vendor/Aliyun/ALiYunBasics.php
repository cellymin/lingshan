<?php
/**
 * Created by PhpStorm.
 * User: lindada
 * Date: 2018/9/13
 * Time: 上午9:27
 */

class ALiYunBasics
{
    public static $AppKey = null;
    public static $AppSecret = null;
    public static $AppCode = null;
    public static $RequestUrl = null;
    public static $method = "POST";
    public static $headers = array();
    public static $file_base64 = null;
    public static $filePath = null;
    public static $body = null;
    public static $requestResult = null;
    public static function fileBase64(){
        $binary = file_get_contents(self::$filePath); // 文件读取
        self::$file_base64 = base64_encode($binary); // 转码
    }
    public static function headers(){
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . self::$AppCode);
        //根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
        self::$headers = $headers;
    }
    public static function curl(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, self::$method);
        curl_setopt($curl, CURLOPT_URL, self::$RequestUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, self::$headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".self::$RequestUrl, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, self::$body);
        $result = curl_exec($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $rheader = substr($result, 0, $header_size);
        $rbody = substr($result, $header_size);
        $httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        //var_dump($result);
         //var_dump($httpCode);
        if($httpCode == 200){
            self::$requestResult = $rbody;
        }else{
            self::$requestResult = null;
        }
    }
}