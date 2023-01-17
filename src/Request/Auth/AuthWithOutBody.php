<?php

namespace Aftwork\TiktokShop\Request\Auth;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Exception;
use GuzzleHttp\Client;

class AuthWithOutBody
{
    /**
     * @param $httpMethod
     * @param $baseUrl
     * @param $apiPath
     * @param $params
     * @param TiktokShopConfig $apiConfig
     * @return mixed|string
     * @throws Exception
     */
    public static function makeGetMethod($httpMethod, $baseUrl, $apiPath, $params, TiktokShopConfig $apiConfig)
    {
        // Validate Input
        if ($apiConfig->getAppKey() == "") throw new Exception("Input of [app_key] is empty");
        if ($apiConfig->getSecretKey() == "") throw new Exception("Input of [secret_key] is empty");

        $apiPath .= "?app_key=".$apiConfig->getAppKey()."&app_secret=".$apiConfig->getSecretKey();

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
            'timeout' => $apiConfig->getTimeOut()
        ]);

        $response = null;

        try
        {
            $response = json_decode($guzzleClient->request($httpMethod, $requestUrl)->getBody()->getContents());
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

} // End Of Class