<?php

/** Open API Request for POST/PUT/DELETE/PATCH */

namespace Haistar\TiktokshopApiClient\node\shop;

use GuzzleHttp\Client;
use Haistar\TiktokshopApiClient\client\TiktokApiConfig;
use Exception;
use Haistar\TiktokshopApiClient\client\SignGenerator;

class ShopWithBodyRequest
{
    /**
     * Static Function For PUT/DELETE/PATCH request
     * @param $httpMethod
     * @param $apiPath
     * @param $params
     * @param $body
     * @param TiktokApiConfig $apiConfig
     */
    public static function makeMethod($httpMethod, $baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig){
        // Validate Input
        if ($apiConfig->getAppKey() == "") throw new Exception("Input of [partner_id] is empty");
        if ($apiConfig->getAccessToken() == "") throw new Exception("Input of [access_token] is empty");
        if ($apiConfig->getShopId() == "") throw new Exception("Input of [shop_id] is empty");
        if ($apiConfig->getSecretKey() == "") throw new Exception("Input of [secret_key] is empty");

        // Timestamp
        $timeStamp = time();
        // Concatenate Base String
        $baseString = $apiConfig->getAppKey()."".$apiPath."".$timeStamp."".$apiConfig->getAccessToken()."".$apiConfig->getShopId();
        $signedKey = SignGenerator::generateSign($baseString, $apiConfig->getSecretKey());

        // Set Header
        $header = array(
            "Content-type : application/json"
        );

        $apiPath .= "?";

        if ($params != null){
            foreach ($params as $key => $value){
                $apiPath .= "&". $key . "=" . urlencode($value);
            }
        }

        $requestUrl = $baseUrl.$apiPath;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $requestUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $httpMethod,
            CURLOPT_HTTPHEADER => $header
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode(utf8_encode($response));

        if ($err) {
            return $err;
        } else {
            return $data;
        }
    }

    /**
     * @param $baseUrl
     * @param $apiPath
     * @param $params
     * @param $body
     * @param TiktokApiConfig $apiConfig
     * @return object|array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function postMethod($baseUrl, $apiPath, $params, $body, TiktokApiConfig $apiConfig)
    {
        // Validate Input
        if ($apiConfig->getAppKey() == "") throw new Exception("Input of [partner_id] is empty");
        if ($apiConfig->getAccessToken() == "") throw new Exception("Input of [access_token] is empty");
        if ($apiConfig->getShopId() == "") throw new Exception("Input of [shop_id] is empty");
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

        return json_decode($guzzleClient->request('POST', $requestUrl, ['json' => $body])->getBody()->getContents());
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

} // End of Class