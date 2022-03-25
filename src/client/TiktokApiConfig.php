<?php

/**
 * @see https://bytedance.feishu.cn/docs/doccnROmkE6WI9zFeJuT3DQ3YOg
 * Tiktok Client Constructor
 * @author Adhi Prayoga
 * @since 24-03-2022
 */

namespace Haistar\TiktokshopApiClient\client;

class TiktokApiConfig
{
    private $partnerId;
    private $accessToken;
    private $refreshToken;
    private $shopId;
    private $secretKey;

    /** 
     * TiktokApiConfig constructor.
     * @param string $partnerId
     * @param string $accessToken
     * @param string $shopId
     * @param string $secretKey
     */
    public function __construct($partnerId = "", $accessToken = "", $refreshToken = "", $shopId = "", $secretKey = "")
    {
        $this->partnerId = $partnerId;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->shopId = $shopId;
        $this->secretKey = $secretKey;        
    }

    /**
     * @return mixed
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @param mixed $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->partnerId = $partnerId;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed|string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param mixed|string $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }


    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @param mixed $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }
}
