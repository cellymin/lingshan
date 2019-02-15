<?php
/**
 * Created by PhpStorm.
 * User: lindada
 * Date: 2018/9/13
 * Time: 上午9:32
 */

include_once __DIR__.'/ALiYunBasics.php';
class MarketIdentity extends  ALiYunBasics
{

    public static $is_old_format = false;
    #正面/反面:face/back
    public static $config = array(
        "side" => "face"
    );
    public static function requestParameter(){
        if( self::$is_old_format ){
            $request = array();
            $request["image"] = array(
                "dataType" => 50,
                "dataValue" => self::$file_base64,
            );
            if(count(self::$config) > 0){
                $request["configure"] = array(
                    "dataType" => 50,
                    "dataValue" => json_encode(self::$config)
                );
            }
            self::$body = json_encode(array("inputs" => array($request)));
        }else{
            $request = array(
                "image" => self::$file_base64
            );
            if(count(self::$config) > 0){
                $request["configure"] = json_encode(self::$config);
            }
            self::$body = json_encode($request);
        }
    }
    public static function request(){
        self::fileBase64();
        self::headers();
        self::requestParameter();
        self::curl();
    }
    public static function curl(){
        parent::curl();
        if(self::$requestResult){
            if(self::$is_old_format){
                $output = json_decode(self::$requestResult, true);
                self::$requestResult = $output["outputs"][0]["outputValue"]["dataValue"];
            }
        }
    }
}