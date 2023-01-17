<?php

namespace Aftwork\TiktokShop\Resource\General;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\General\GeneralWithBody;
use Aftwork\TiktokShop\Request\General\GeneralWithOutBody;


class TiktokShopGeneralResource
{
    // GET Request
    /**
     * @throws \Exception
     */
    public function httpCallGet($baseUrl, $apiPath, $params, TiktokShopConfig $apiConfig)
    {
        $httpMethod = "GET";
        return GeneralWithOutBody::makeGetMethod($httpMethod, $baseUrl, $apiPath, $params, $apiConfig);
    }

    // POST Request
    /**
     * @throws \Exception
     */
    public function httpCallPost($baseUrl, $apiPath, $params, $body, TiktokShopConfig $apiConfig)
    {
        $httpMethod = "POST";
        return GeneralWithBody::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }

    // PUT Request
    /**
     * @throws \Exception
     */
    public function httpCallPut($baseUrl, $apiPath, $params, $body, TiktokShopConfig $apiConfig)
    {
        $httpMethod = "PUT";
        return GeneralWithBody::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }


    // PATCH Request
    /**
     * @throws \Exception
     */
    public function httpCallPatch($baseUrl, $apiPath, $params, $body, TiktokShopConfig $apiConfig)
    {
        $httpMethod = "PATCH";
        return GeneralWithBody::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }


    // DELETE Request
    /**
     * @throws \Exception
     */
    public function httpCallDelete($baseUrl, $apiPath, $params, $body, TiktokShopConfig $apiConfig)
    {
        $httpMethod = "DELETE";
        return GeneralWithBody::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }
}