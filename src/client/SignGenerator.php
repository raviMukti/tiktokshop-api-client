<?php

namespace Haistar\TiktokshopApiClient\client;

class SignGenerator
{
    public static function generateSign($baseString, $key){
        return hash_hmac('sha256', utf8_encode($baseString), $key);
    }
}