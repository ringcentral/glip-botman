<?php


require('vendor/autoload.php');

use RingCentral\SDK\SDK;
use Symfony\Component\HttpFoundation\Response;

// Parse the .env file
$dotenv = new Dotenv\Dotenv(getcwd());
$dotenv->load();


try {

    if (!isset($_GET['code'])) {
        return;
    }

    // Create SDK instance
    $rcsdk = new SDK($_ENV['GLIP_APPKEY'], $_ENV['GLIP_APPSECRET'] , $_ENV['GLIP_SERVER'], 'Demo', '1.0.0');

    // Create Platform instance
    $platform = $rcsdk->platform();
    $qs = $platform->parseAuthRedirectUrl($_SERVER['QUERY_STRING']);
    $qs["redirectUri"] = $_ENV['GLIP_REDIRECT_URL'];
    $auth = $platform->login($qs);

    /*
     * Using the caching mechanism
     */
    $cacheDir = __DIR__ . DIRECTORY_SEPARATOR . '_cache';
    $file = $cacheDir . DIRECTORY_SEPARATOR . 'platform.json';
    if (!file_exists($cacheDir)) {
        mkdir($cacheDir);
    }
    file_put_contents($file, json_encode($platform->auth()->data(), JSON_PRETTY_PRINT));

    print PHP_EOL . "Wohooo, your Bot is on-boarded to Glip." . PHP_EOL;


} catch (Exception $e) {

    print 'Webhook Provision Error: ' . $e->getMessage() . PHP_EOL;

}