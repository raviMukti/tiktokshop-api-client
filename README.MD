# Unofficial Tiktok Shop API Client build in PHP

### How To Install

`composer require haistar/tiktokshop-api-client`

### Generate Authorization URL

```
$authUrl = TiktokShopAuthResource::generateAuthUrl($_ENV["AUTH_URL"], $_ENV["APP_KEY"]);
```

### Get Access Token

```
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
```

### Renew Refresh Token

```
$tiktokShopConfig = new TiktokShopConfig();
$tiktokShopConfig->setAppKey($_ENV["APP_KEY"]);
$tiktokShopConfig->setSecretKey($_ENV["APP_SECRET"]);

$tiktokAuthResource = new TiktokShopAuthResource();

$baseUrl = $_ENV["AUTH_URL"];
$apiRenewRefreshToken = "/api/v2/token/refresh";

$params = [
    "refresh_token" => $_ENV["REFRESH_TOKEN"],
    "grant_type" => "refresh_token",
];

$response = $tiktokAuthResource->httpCallGet($baseUrl, $apiRenewRefreshToken, $params, $tiktokShopConfig);

$this->assertEquals("0", $response->code);
$this->assertEquals("success", $response->success);
```

### TiktokShop Global API

```
$tiktokShopConfig = new TiktokShopConfig();
$tiktokShopConfig->setAppKey($_ENV["APP_KEY"]);
$tiktokShopConfig->setSecretKey($_ENV["APP_SECRET"]);
$tiktokShopConfig->setAccessToken($_ENV["ACCESS_TOKEN"]);

$tiktokGeneralResource = new TiktokShopGeneralResource();

$baseUrl = $_ENV["SERVER_URL"];
$apiAuthorizedShop = "/api/shop/get_authorized_shop";

$response = $tiktokGeneralResource->httpCallGet($baseUrl, $apiAuthorizedShop, [], $tiktokShopConfig);

$this->assertEquals(0, $response->code);
$this->assertEquals($_ENV["SELLER_NAME"], $response->data->shop_list[0]->shop_name);
```

