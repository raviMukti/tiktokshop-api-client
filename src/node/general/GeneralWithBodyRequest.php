<?php

namespace Haistar\TiktokshopApiClient\node\general;

use Haistar\TiktokshopApiClient\client\TiktokApiConfig;
use Exception;
use GuzzleHttp\Client;
use Haistar\TiktokshopApiClient\client\SignGenerator;

class GeneralWithBodyRequest
{
    /**
     * @param $httpMethod
     * @param $apiPath
     * @param $params
     * @param $body
     * @param TiktokApiConfig $TiktokApiConfig
     */
    public static function makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        // Validate Input
        /** @var TiktokApiConfig $apiConfig */
        if ($apiConfig->getAppKey() == "") throw new Exception("Input of [app_key] is empty");
        if ($apiConfig->getSecretKey() == "") throw new Exception("Input of [secret_key] is empty");

        // Timestamp
        $timeStamp = time();
        
        $apiPath .= "?";

        if ($params != null)
        {
            foreach ($params as $key => $value)
            {
                $apiPath .= "&". $key . "=" . urlencode($value);
            }
        }

        $requestUrl = $baseUrl.$apiPath;

        $guzzleClient = new Client([
            'base_uri' => $baseUrl,
            'timeout' => 3.0
        ]);

        return json_decode($guzzleClient->request($httpMethod, $requestUrl, ['json' => $body])->getBody()->getContents());
    }
}