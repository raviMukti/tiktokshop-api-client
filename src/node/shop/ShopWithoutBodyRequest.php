<?php


namespace Haistar\TiktokshopApiClient\node\shop;


use Haistar\TiktokshopApiClient\client\TiktokApiConfig;
use Haistar\TiktokshopApiClient\client\SignGenerator;
use Exception;
use GuzzleHttp\Client;

class ShopWithoutBodyRequest
{
    /**
     * @param $httpMethod
     * @param $baseUrl
     * @param $apiPath
     * @param $params
     * @param TiktokApiConfig $apiConfig
     * @return mixed|string
     * @throws Exception
     */
    public static function makeGetMethod($httpMethod, $baseUrl, $apiPath, $params, TiktokApiConfig $apiConfig)
    {
        
        // Validate Input
        if ($apiConfig->getAppKey() == "") throw new Exception("Input of [app_key] is empty");
        if ($apiConfig->getAccessToken() == "") throw new Exception("Input of [access_token] is empty");
        if($apiPath != "/api/shop/get_authorized_shop")
        {
            if ($apiConfig->getShopId() == "") throw new Exception("Input of [shop_id] is empty");
        }
        if ($apiConfig->getSecretKey() == "") throw new Exception("Input of [secret_key] is empty");

        //Timestamp
        $timeStamp = time();

        $params["timestamp"] = $timeStamp;

        // Concatenate Base String
        $baseString = self::createBaseString($apiPath, $apiConfig->getSecretKey(), $params);

        $signedKey = SignGenerator::generateSign($baseString, $apiConfig->getSecretKey());

        $params["sign"] = $signedKey;

        $apiPath .= "?";

        if ($params != null){
            foreach ($params as $key => $value){
                $apiPath .= "&". $key . "=" . urlencode($value);
            }
        }

        $requestUrl = $baseUrl.$apiPath;

        $guzzleClient = new Client([
            'base_uri' => $baseUrl,
            'timeout' => 3.0
        ]);

        return json_decode($guzzleClient->request($httpMethod, $requestUrl)->getBody()->getContents());
    }
    
    /**
     * Method createBaseString
     * @param string $apiPathName
     * @param string $appSecret
     * @param array $params
     *
     * @return string
     */
    private static function createBaseString($apiPathName, $appSecret, array $params)
    {
        ksort($params);
		$stringToBeSigned = $appSecret;
        $stringToBeSigned .= $apiPathName;
		foreach ($params as $k => $v)
		{
			if($k != "access_token" && $k != "sign" && "@" != substr($v, 0, 1))
			{
				$stringToBeSigned .= "$k$v";
			}
		}
		unset($k, $v);
		return $stringToBeSigned .= $appSecret;
    }


} // End Of Class