<?php

namespace App\Helpers;

class APIHelper {


    public static function APIResponse($iserror, $code, $message, $content = null){
        $result = [];

        if($iserror){
            $result['success'] = false;
            $result['code'] = $code;
            $result['message'] = $message;
        }else{
            $result['success'] = true;
            $result['code'] = $code;

            if($content == null){
                $result['message'] = $message;
            }else{
                $result['data'] = $content;
            }
        }

        return $result;
    }

    public static function GENERATE_NIN($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

}