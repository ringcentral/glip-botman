<?php

require('vendor/autoload.php');

use RingCentral\SDK\SDK;


// Parse the .env file
$dotenv = new Dotenv\Dotenv(getcwd());
$dotenv->load();


try {

    // Create a Subscription using webhooks method
//    $rcsdk = new SDK($_ENV['GLIP_APPKEY'], $_ENV['GLIP_APPSECRET'] , $_ENV['GLIP_SERVER'], 'Demo', '1.0.0');
//
//    $platform = $rcsdk->platform();
//
//    $auth = $platform->login($_ENV['GLIP_USERNAME'], $_ENV['GLIP_EXTENSION'], $_ENV['GLIP_PASSWORD']);


    if (!isset($_GET['code'])) {
        return;
    }

    // Create SDK instance
    $rcsdk = new SDK($_ENV['GLIP_APPKEY'], $_ENV['GLIP_APPSECRET'] , $_ENV['GLIP_SERVER'], 'Demo', '1.0.0');

    // Create Platform instance
    $platform = $rcsdk->platform();
    $qs = $platform->parseAuthRedirectUrl($_SERVER['QUERY_STRING']);
    $qs["redirectUri"] = $_ENV['GLIP_REDIRECT_URL'];
    $apiResponse = $platform->login($qs);

    print 'The Tokens is : ' . PHP_EOL . print_r($apiResponse->text());


    // Setup the Webhook Subscription
    $apiResponse = $platform->post('/subscription',array(
        "eventFilters"=>array(
            "/restapi/v1.0/glip/groups",
            "/restapi/v1.0/glip/posts"
        ),
        "deliveryMode"=>array(
            "transportType"=> "WebHook",
            "address"=>$_ENV['GLIP_WEBHOOK_URL']
        )
    ));

    print PHP_EOL . "Wohooo, your Bot is Registered. Please follow the instructions on on-boarding the bot into Glip" . PHP_EOL;

} catch (Exception $e) {

    print 'Webhook Setup Error: ' . $e->getMessage() . PHP_EOL;

}


