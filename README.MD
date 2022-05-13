# Unofficial Tiktok Shop API Client build in PHP

### How To Install

`composer require haistar/tiktokshop-api-client`

### How To Use

```
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
```
