<?php

namespace Test\api\request;

use Dotenv\Dotenv;
use Haistar\TiktokshopApiClient\client\TiktokApiConfig;
use Haistar\TiktokshopApiClient\request\shop\ShopApiClient;
use PHPUnit\Framework\TestCase;

class ShopApiRequestTest extends TestCase
{
    protected function setUp()
    {
        $dotEnv = Dotenv::createImmutable(__DIR__."./../../../");
        $dotEnv->safeLoad();
    }

    protected function tearDown()
    {
        return null;
    }

    public function testAuthorizeShopId_AndReturnSuccess()
    {
        $tiktokApiClient = new ShopApiClient();
        $tiktokApiConfig = new TiktokApiConfig();
        $tiktokApiConfig->setAppKey($_ENV["APP_KEY"]);
        $tiktokApiConfig->setSecretKey($_ENV["APP_SECRET"]);
        $tiktokApiConfig->setAccessToken($_ENV["ACCESS_TOKEN"]);
        
        $baseUrl = $_ENV["SERVER_URL"];
        $apiPath = "/api/shop/get_authorized_shop";

        $params = array(
            "app_key" => $tiktokApiConfig->getAppKey(),
            "access_token" => $tiktokApiConfig->getAccessToken(),
        );

        $responseAuthShopId = $tiktokApiClient->httpCallGet($baseUrl, $apiPath, $params, $tiktokApiConfig);

        self::assertEquals(0, $responseAuthShopId->code);
    }

    public function testGetCategories_AndReturnSuccess()
    {
        $tiktokApiClient = new ShopApiClient();
        $tiktokApiConfig = new TiktokApiConfig();
        $tiktokApiConfig->setAppKey($_ENV["APP_KEY"]);
        $tiktokApiConfig->setSecretKey($_ENV["APP_SECRET"]);
        $tiktokApiConfig->setAccessToken($_ENV["ACCESS_TOKEN"]);
        $tiktokApiConfig->setShopId($_ENV["SHOP_ID"]);
        
        $baseUrl = $_ENV["SERVER_URL"];
        $apiPath = "/api/products/categories";

        $params = array(
            "app_key" => $tiktokApiConfig->getAppKey(),
            "shop_id" => $tiktokApiConfig->getShopId(),
            "access_token" => $tiktokApiConfig->getAccessToken(),
        );

        $responseCategories = $tiktokApiClient->httpCallGet($baseUrl, $apiPath, $params, $tiktokApiConfig);

        self::assertEquals(0, $responseCategories->code);
    }

    public function testGetProductList_AndReturnSuccess()
    {
        $tiktokApiClient = new ShopApiClient();
        $tiktokApiConfig = new TiktokApiConfig();
        $tiktokApiConfig->setAppKey($_ENV["APP_KEY"]);
        $tiktokApiConfig->setSecretKey($_ENV["APP_SECRET"]);
        $tiktokApiConfig->setAccessToken($_ENV["ACCESS_TOKEN"]);
        $tiktokApiConfig->setShopId($_ENV["SHOP_ID"]);
        
        $baseUrl = $_ENV["SERVER_URL"];
        $apiPath = "/api/products/search";

        $params = array(
            "app_key" => $tiktokApiConfig->getAppKey(),
            "shop_id" => $tiktokApiConfig->getShopId(),
            "access_token" => $tiktokApiConfig->getAccessToken(),
        );

        $body = array(
            "page_number" => 1,
            "page_size" =>  100,
            "search_status" => 0 // 0-all、1-draft、2-pending、3-failed、4-live、5-seller_deactivated、6-platform_deactivated、7-freeze
        );

        $responseProductList = $tiktokApiClient->httpCallPost($baseUrl, $apiPath, $params, $body,$tiktokApiConfig);

        self::assertEquals(0, $responseProductList->code);
    }

}