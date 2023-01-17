<?php

namespace Aftwork\TiktokShop\Resource\Auth;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Auth\AuthWithBody;
use Aftwork\TiktokShop\Request\Auth\AuthWithOutBody;


class TiktokShopAuthResource
{
    // GET Request
    /**
     * @throws \Exception
     */
    public function httpCallGet($baseUrl, $apiPath, $params, TiktokShopConfig $apiConfig)
    {
        $httpMethod = "GET";
        return AuthWithOutBody::makeGetMethod($httpMethod, $baseUrl, $apiPath, $params, $apiConfig);
    }


    /**
     * Generate Auth URL
     * @param mixed $baseUrl
     * @param mixed $appKey
     * @return string
     */
    public static function generateAuthUrl($baseUrl, $appKey)
    {
        return $baseUrl . "/oauth/authorize?app_key=" . $appKey . "&state=" . rand(10000, 99999);
    }

}