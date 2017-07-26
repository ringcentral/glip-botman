<?php

require('vendor/autoload.php');
require('GlipBotman.php');

use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan\BotMan;
use Mpociot\BotMan\DriverManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GlipBotman\GlipBotman;

// Parse the .env file
$dotenv = new Dotenv\Dotenv(getcwd());
$dotenv->load();


// Load the values from .env
$config = [
    'GLIP_SERVER' => $_ENV['GLIP_SERVER'],
    'GLIP_APPKEY' => $_ENV['GLIP_APPKEY'],
    'GLIP_APPSECRET' => $_ENV['GLIP_APPSECRET'],
    'GLIP_USERNAME' => $_ENV['GLIP_USERNAME'],
    'GLIP_PASSWORD' => $_ENV['GLIP_PASSWORD'],
    'GLIP_EXTENSION' => $_ENV['GLIP_EXTENSION'],
];


// Create the Subscription using Webhooks Method
$cacheDir = __DIR__ . DIRECTORY_SEPARATOR . '_subscribe';
if (!file_exists($cacheDir)) {

    mkdir($cacheDir);
    $request = Request::createFromGlobals();
    // GlipWebhook verification
    if ($request->headers->has('Validation-Token'))
    {

        return Response::create('',200,array('Validation-Token' => getallheaders()['Validation-Token']))->send();
    }
}

// Load the Driver into Botman
DriverManager::loadDriver(GlipBotman::class);

print "The vaialble drivers are : ". print_r(DriverManager::getAvailableDrivers());

// Create a Botman Instance
$botman = BotManFactory::create($config);


// Give the bot something to listen for.
$botman->hears('hello', function (BotMan $bot) {
    $bot->reply('Hello yourself dude.');
})->driver(GlipBotman::class);


$botman->hears('hello1', function (BotMan $bot) {
    $bot->reply('I am still under construction');
})->driver(GlipBotman::class);


// Start listening
$botman->listen();