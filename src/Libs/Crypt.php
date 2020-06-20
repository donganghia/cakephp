<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Libs;

class Crypt
{
    /*
     http://www.imcore.net | hosihito@gmail.com
     Developer. Kyoungbin Lee
     2012.09.07

     AES256 EnCrypt / DeCrypt
    */
    private static $key = 'abcdefghijklmnopqrstuvwxyz123456';
    private static $securityRefix = 'vtm2018';

    public static function encrypAES($plain_text)
    {
        $plain_text = self::$securityRefix . $plain_text;
        return self::base64_url_encode(openssl_encrypt($plain_text, "aes-256-cbc", self::$key, true, str_repeat(chr(0), 16)));
    }

    public static function decryptAES($base64_text)
    {
        $value = openssl_decrypt(self::base64_url_decode($base64_text), "aes-256-cbc", self::$key, true, str_repeat(chr(0), 16));
        $refix =  substr($value, 0, strlen(self::$securityRefix));
        if($refix == self::$securityRefix){
            return substr($value, strlen(self::$securityRefix));
        }
        return null;
    }

    private static function base64_url_encode($input) {
        $base = base64_encode($input);
        return str_replace(['+','/','='], ['-','_',''], $base);
    }

    private static  function base64_url_decode($input) {
        $base = str_replace(['-','_',''], ['+','/','='], $input);
        return base64_decode($base);
    }
}