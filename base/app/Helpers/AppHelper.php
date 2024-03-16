<?php
namespace App\Helpers;

class AppHelper
{
    public static function openEncrypt($id){
        $output = false;
             $encrypt_method = "AES-256-CBC";
             $secret_key = 'user-SH'; // need to be constant
             $secret_iv = 'user-SH'; // need to be constant
             // hash
             $key = hash('sha256', $secret_key);
             // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
             $iv = substr(hash('sha256', $secret_iv), 0, 16);
             $output = base64_encode(openssl_encrypt($id, $encrypt_method, $key, 0, $iv));

        return $output;
    }

    public static function openDecrypt($id){

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'user-SH'; // need to be constant
        $secret_iv = 'user-SH';    // need to be constant
                         // hash
        $key = hash('sha256', $secret_key);
                         // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($id), $encrypt_method, $key, 0, $iv);
        return $output ;
    }
}
