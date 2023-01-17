<?php

namespace Test;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Resource\Auth\TiktokShopAuthResource;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class AuthRequestTest extends TestCase
{
    protected function setUp()
    {
        $dotEnv = Dotenv::createImmutable(__DIR__."./../");
        $dotEnv->safeLoad();
    }

    protected function tearDown()
    {
        return null;
    }

    public function test_generate_auth_url()
    {
        $authUrl = TiktokShopAuthResource::generateAuthUrl($_ENV["AUTH_URL"], $_ENV["APP_KEY"]);

        $this->assertIsString($authUrl);
    }

    public function test_generate_access_token()
    {
        $tiktokShopConfig = new TiktokShopConfig();
        $tiktokShopConfig->setAppKey($_ENV["APP_KEY"]);
        $tiktokShopConfig->setSecretKey($_ENV["APP_SECRET"]);

        $tiktokAuthResource = new TiktokShopAuthResource();

        $baseUrl = $_ENV["AUTH_URL"];
        $apiAccessToken = "/api/v2/token/get";

        $params = [
            "auth_code" => $_ENV["AUTH_CODE"],
            "grant_type" => "authorized_code",
        ];

        $response = $tiktokAuthResource->httpCallGet($baseUrl, $apiAccessToken, $params, $tiktokShopConfig);

        $this->assertEquals("0", $response->code);
        $this->assertEquals("success", $response->success);
    }

    public function test_refresh_token()
    {
        $tiktokShopConfig = new TiktokShopConfig();
        $tiktokShopConfig->setAppKey($_ENV["APP_KEY"]);
        $tiktokShopConfig->setSecretKey($_ENV["APP_SECRET"]);

        $tiktokAuthResource = new TiktokShopAuthResource();

        $baseUrl = $_ENV["AUTH_URL"];
        $apiAccessToken = "/api/v2/token/refresh";

        $params = [
            "refresh_token" => $_ENV["REFRESH_TOKEN"],
            "grant_type" => "refresh_token",
        ];

        $response = $tiktokAuthResource->httpCallGet($baseUrl, $apiAccessToken, $params, $tiktokShopConfig);

        $this->assertEquals("0", $response->code);
        $this->assertEquals("success", $response->success);
    }
}