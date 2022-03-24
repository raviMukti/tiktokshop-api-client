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
    public static function makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig){
        // Validate Input
        /** @var TiktokApiConfig $apiConfig */
        if ($apiConfig->getPartnerId() == "") throw new Exception("Input of [partner_id] is empty");
        if ($apiConfig->getSecretKey() == "") throw new Exception("Input of [secret_key] is empty");

        // Timestamp
        $timeStamp = time();
        // Concatenate Base String
        $baseString = $apiConfig->getPartnerId()."".$apiPath."".$timeStamp;
        $signedKey = SignGenerator::generateSign($baseString, $apiConfig->getSecretKey());

        $apiPath .= "?";

        if ($params != null){
            foreach ($params as $key => $value){
                $apiPath .= "&". $key . "=" . urlencode($value);
            }
        }

        $requestUrl = $baseUrl.$apiPath."&"."partner_id=".urlencode($apiConfig->getPartnerId())."&"."timestamp=".urlencode($timeStamp)."&"."sign=".urldecode($signedKey);

        $guzzleClient = new Client([
            'base_uri' => $baseUrl,
            'timeout' => 3.0
        ]);

        return json_decode($guzzleClient->request($httpMethod, $requestUrl, ['json' => $body])->getBody()->getContents());
    }
}