<?php

namespace Haistar\TiktokshopApiClient\request\general;

use Haistar\TiktokshopApiClient\client\TiktokApiConfig;
use Haistar\TiktokshopApiClient\node\general\GeneralWithBodyRequest;
use Haistar\TiktokshopApiClient\node\general\GeneralWithoutBodyRequest;

class GeneralApiClient
{
    // GET Request
    /**
     * @throws \Exception
     */
    public function httpCallGet($baseUrl, $apiPath, $params, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "GET";
        return GeneralWithoutBodyRequest::makeGetMethod($httpMethod, $baseUrl, $apiPath, $params, $apiConfig);
    }

    // POST Request
    /**
     * @throws \Exception
     */
    public function httpCallPost($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "POST";
        return GeneralWithBodyRequest::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }

    // PUT Request
    /**
     * @throws \Exception
     */
    public function httpCallPut($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "PUT";
        return GeneralWithBodyRequest::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }


    // PATCH Request
    /**
     * @throws \Exception
     */
    public function httpCallPatch($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "PATCH";
        return GeneralWithBodyRequest::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }


    // DELETE Request
    /**
     * @throws \Exception
     */
    public function httpCallDelete($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        $httpMethod = "DELETE";
        return GeneralWithBodyRequest::makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, $apiConfig);
    }
}