<?php

namespace Aftwork\TiktokShop\Request\General;

use Aftwork\TiktokShop\Common\SignGenerator;
use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Exception;
use GuzzleHttp\Client;

class GeneralWithBody
{
    /**
     * @param $httpMethod
     * @param $apiPath
     * @param $params
     * @param $body
     * @param TiktokShopConfig $apiConfig
     */
    public static function makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, TiktokShopConfig $apiConfig)
    {
        // Validate Input
        /** @var TiktokShopConfig $apiConfig */
        if ($apiConfig->getAppKey() == "") throw new Exception("Input of [app_key] is empty");
        if ($apiConfig->getSecretKey() == "") throw new Exception("Input of [secret_key] is empty");
        if ($apiConfig->getAccessToken() == "") throw new Exception("Input of [access_token] is empty");
        if ($apiConfig->getShopId() == "") throw new Exception("Input of [shop_id] is empty");

        //Timestamp
        $timeStamp = time();
        $params["timestamp"] = $timeStamp;
        $params["app_key"] = $apiConfig->getAppKey();

        $signedKey = SignGenerator::generateSign($apiPath, $apiConfig->getSecretKey(), $params);

        $params["sign"] = $signedKey;

        $apiPath .= "?";

        if ($params != null)
        {
            foreach ($params as $key => $value)
            {
                $apiPath .= "&". $key . "=" . urlencode($value);
            }
        }

        $requestUrl = $baseUrl . $apiPath . "&access_token=" .urlencode($apiConfig->getAccessToken());

        $guzzleClient = new Client([
            'base_uri' => $baseUrl,
            'timeout' => $apiConfig->getTimeOut()
        ]);

        $response = null;

        try
        {
            $response = json_decode($guzzleClient->request($httpMethod, $requestUrl, ['json' => $body])->getBody()->getContents());
        }
        catch (\GuzzleHttp\Exception\ClientException $e)
        {
            $response = json_decode($e->getResponse()->getBody()->getContents());
        }
        catch(\Throwable $e)
        {
            $response = (object) array("error" => "GUZZLE_ERROR", "message" => $e->getMessage());
        }

        return $response;
    }

}