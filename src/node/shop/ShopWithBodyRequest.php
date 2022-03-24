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
        if ($apiConfig->getPartnerId() == "") throw new Exception("Input of [partner_id] is empty");
        if ($apiConfig->getAccessToken() == "") throw new Exception("Input of [access_token] is empty");
        if ($apiConfig->getShopId() == "") throw new Exception("Input of [shop_id] is empty");
        if ($apiConfig->getSecretKey() == "") throw new Exception("Input of [secret_key] is empty");

        // Timestamp
        $timeStamp = time();
        // Concatenate Base String
        $baseString = $apiConfig->getPartnerId()."".$apiPath."".$timeStamp."".$apiConfig->getAccessToken()."".$apiConfig->getShopId();
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

        $requestUrl = $baseUrl.$apiPath."&"."partner_id=".urlencode($apiConfig->getPartnerId())."&"."shop_id=".urlencode($apiConfig->getShopId())."&"."access_token=".urlencode($apiConfig->getAccessToken())."&"."timestamp=".urlencode($timeStamp)."&"."sign=".urlencode($signedKey);

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
        if ($apiConfig->getPartnerId() == "") throw new Exception("Input of [partner_id] is empty");
        if ($apiConfig->getAccessToken() == "") throw new Exception("Input of [access_token] is empty");
        if ($apiConfig->getShopId() == "") throw new Exception("Input of [shop_id] is empty");
        if ($apiConfig->getSecretKey() == "") throw new Exception("Input of [secret_key] is empty");

        //Timestamp
        $timeStamp = time();
        // Concatenate Base String
        $baseString = $apiConfig->getPartnerId()."".$apiPath."".$timeStamp."".$apiConfig->getAccessToken()."".$apiConfig->getShopId();
        $signedKey = SignGenerator::generateSign($baseString, $apiConfig->getSecretKey());

        $apiPath .= "?";

        if ($params != null){
            foreach ($params as $key => $value){
                $apiPath .= "&". $key . "=" . urlencode($value);
            }
        }

        $requestUrl = $baseUrl.$apiPath."&"."partner_id=".urlencode($apiConfig->getPartnerId())."&"."shop_id=".urlencode($apiConfig->getShopId())."&"."access_token=".urlencode($apiConfig->getAccessToken())."&"."timestamp=".urlencode($timeStamp)."&"."sign=".urlencode($signedKey);

        $guzzleClient = new Client([
            'base_uri' => $baseUrl,
            'timeout' => 3.0
        ]);

        return json_decode($guzzleClient->request('POST', $requestUrl, ['json' => $body])->getBody()->getContents());
    }


} // End of Class