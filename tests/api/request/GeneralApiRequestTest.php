<?php

namespace Test\api\request;

use Dotenv\Dotenv;
use Haistar\TiktokshopApiClient\client\TiktokApiConfig;
use Haistar\TiktokshopApiClient\request\general\GeneralApiClient;
use PHPUnit\Framework\TestCase;

class GeneralApiRequestTest extends TestCase
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

    public function testGenerateAccessToken_AndReturnSuccess()
    {
        self::markTestSkipped("AVOID ERROR WHEN CALL API");
        $tiktokApiClient = new GeneralApiClient();
        $tiktokApiConfig = new TiktokApiConfig();
        $tiktokApiConfig->setAppKey($_ENV["APP_KEY"]);
        $tiktokApiConfig->setSecretKey($_ENV["APP_SECRET"]);
        
        $baseUrl = $_ENV["AUTH_URL"];
        $apiPath = "/api/token/getAccessToken";

        $params = array();

        $body = array(
            "app_key" => $tiktokApiConfig->getAppKey(),
            "app_secret" => $tiktokApiConfig->getSecretKey(),
            "auth_code" => $_ENV["AUTH_CODE"],
            "grant_type" => "authorized_code"
        );

        $responseAccessToken = $tiktokApiClient->httpCallPost($baseUrl, $apiPath, $params, $body, $tiktokApiConfig);

        self::assertEquals(0, $responseAccessToken->code);
        self::assertEquals("success", $responseAccessToken->message);
    }

    public function testGenerateRefreshToken_AndReturnSuccess()
    {
        self::markTestSkipped("AVOID ERROR WHEN CALL API");
        $tiktokApiClient = new GeneralApiClient();
        $tiktokApiConfig = new TiktokApiConfig();
        $tiktokApiConfig->setAppKey($_ENV["APP_KEY"]);
        $tiktokApiConfig->setSecretKey($_ENV["APP_SECRET"]);
        
        $baseUrl = $_ENV["AUTH_URL"];
        $apiPath = "/api/token/refreshToken";

        $params = array();

        $body = array(
            "app_key" => $tiktokApiConfig->getAppKey(),
            "app_secret" => $tiktokApiConfig->getSecretKey(),
            "refresh_token" => $_ENV["REFRESH_TOKEN"],
            "grant_type" => "refresh_token"
        );

        $responseRefreshToken = $tiktokApiClient->httpCallPost($baseUrl, $apiPath, $params, $body, $tiktokApiConfig);

        self::assertEquals(0, $responseRefreshToken->code);
        self::assertEquals("success", $responseRefreshToken->message);
    }
}