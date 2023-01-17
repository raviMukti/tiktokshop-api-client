<?php

/**
 * @see https://bytedance.feishu.cn/docs/doccnROmkE6WI9zFeJuT3DQ3YOg
 * Tiktok Client Constructor
 * @author Adhi Prayoga
 * @since 24-03-2022
 */

namespace Aftwork\TiktokShop\Common;

class TiktokShopConfig
{
    private $appKey;
    private $accessToken;
    private $refreshToken;
    private $shopId;
    private $secretKey;
    private $timeOut;

    /**
     * TiktokApiConfig constructor.
     * @param string $appKey
     * @param string $accessToken
     * @param string $shopId
     * @param string $secretKey
     * @param int $timeOut
     */
    public function __construct($appKey = "", $accessToken = "", $refreshToken = "", $shopId = "", $secretKey = "", $timeOut = 3)
    {
        $this->appKey = $appKey;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->shopId = $shopId;
        $this->secretKey = $secretKey;
        $this->timeOut = $timeOut;
    }

     /**
     * Get the value of appKey
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * Set the value of appKey
     */
    public function setAppKey($appKey): self
    {
        $this->appKey = $appKey;

        return $this;
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

    /**
     * Get the value of timeOut
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * Set the value of timeOut
     */
    public function setTimeOut($timeOut): self
    {
        $this->timeOut = $timeOut;

        return $this;
    }
}
