<?php


namespace Haistar\TiktokshopApiClient\request\shop;


use Haistar\TiktokshopApiClient\client\TiktokApiConfig;
use Haistar\TiktokshopApiClient\node\shop\ShopWithoutBodyRequest;
use Haistar\TiktokshopApiClient\node\shop\ShopWithBodyRequest;

class ShopApiClient
{
    // GET Request
    /**
     * @throws \Exception
     */
    public function httpCallGet($baseUrl, $apiPath, $params, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "GET";
        return ShopWithoutBodyRequest::makeGetMethod($httpMethod, $baseUrl, $apiPath, $params, $apiConfig);
    }

    // POST Request

    /**
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpCallPost($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        return ShopWithBodyRequest::postMethod($baseUrl, $apiPath, $params, $body, $apiConfig);
    }

    // PUT Request
    /**
     * @throws \Exception
     */
    public function httpCallPut($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "PUT";
        return ShopWithBodyRequest::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }


    // PATCH Request
    /**
     * @throws \Exception
     */
    public function httpCallPatch($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "PATCH";
        return ShopWithBodyRequest::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }


    // DELETE Request
    /**
     * @throws \Exception
     */
    public function httpCallDelete($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "DELETE";
        return ShopWithBodyRequest::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }

}