# Glip - Botman

[Glip](https://glip.com/) Adaptor for [Botman](https://botman.io/1.5/installation).

![APP screenshots](assets/botman_glip.png)

This is a simple Botman Adaptor for Glip which is ready to use and fairly simple to install. Before we install, lets look at the requirements below:
 
 
## Requirement

 - PHP 5.5+
 - CURL extension
 - MCrypt extension
 - ngrok tunneling
 

## Installation

### Via Composer

- `git clone https://github.com/anilkumarbp/glip-botman.git`
- `cd glip-botman`
- `curl -sS https://getcomposer.org/installer | php`
- `composer install`


## Configure your Bot

### Provide Bot User details in `.env` file:

```php
$ cd glip-botman
$ cp .env.sample .env
$ vi .env
```

Edit the .env file to add the app details and user details.

```php
    GLIP_SERVER=https://platform.devtest.ringcentral.com        // Server Url ( Production: https://platform.ringcentral.com || Sandbox: https://platform.devtest.ringcentral.com )
    GLIP_APPKEY=appKey                                              
    GLIP_APPSECRET=appSecret                                     
    GLIP_USERNAME=Username                                  
    GLIP_PASSWORD=Password                                
    GLIP_EXTENSION=Extension                                
```

## Usage 

Note: The demo assumes that you are not using a Live server instead the PHP's [Built-In Web server](http://php.net/manual/en/features.commandline.webserver.php) and the tunneling service from [ngrok](https://ngrok.com/).

### Start the PHP built-in Web Server locally
 
```php
php -S localhost:8080
```

### Start ngrok ( for demo purposes using ngrok )

```bash
$ ngrok http 8080
```

### Setup Webhook URL for the Bot
Just point the webhook subscription URL to: ( you must start ngrok if using it ) lets say the above step gives you an endpoint for the server as below:
```php
https://f0aad057.ngrok.io/index.php
```
Add this to the .env parameter `GLIP_WEBHOOK_URL` created above. 

## Start the Bot

In the terminal, just run this command:

```php
$ php index.php
```

## Extending the Botman-Glip Adapter

You can set the `Bot` to listen to any specific commands/instructions . You can include the commands in the php file whihc is used to setup the Webhook. In our case, it is `webhook.php`

```php
// Give the bot something to listen for.
$botman->hears('hello', function (BotMan $bot) {
    $bot->reply('Hello yourself.');
});


$botman->hears('how are you doing', function (BotMan $bot) {
    $bot->reply('I am fine how are you doing today ?');
});
```

For more details, please take a look at Botman's official guide on [Hearing Messages](https://botman.io/1.5/receiving)


## Dependencies

Currently used RingCentral-PHP SDK version for this demo:  
[ "ringcentral/ringcentral-php": "^2.0.0"](https://github.com/ringcentral/ringcentral-php)  
["mpociot/botman":"latest"](https://github.com/mpociot/botman)

* Make sure to change the SDK version in the composer.json before you chose to use a different SDK Version.


## Links

Project Repo

* https://github.com/anilkumarbp/glip-botman

RingCentral SDK for PHP

* https://github.com/ringcentral/ringcentral-php

RingCentral API Docs

* https://developer.ringcentral.com/api-and-docs.html

RingCentral API Explorer

* https://developer.ringcentral.com/api-explorer/latest/index.html

## Contributions

Any reports of problems, comments or suggestions are most welcome.

Please report these on [glip-botman's Issue Tracker in Github](https://github.com/anilkumarbp/glip-botman/issues).

## License

RingCentral SDK is available under an MIT-style license. See [LICENSE.txt](LICENSE.txt) for details.

RingCentral SDK &copy; 2017 by RingCentral

## FAQ

* What if I do not have a RingCentral account? Don't have an account, no worries: [Become a RingCentral Customer](https://www.ringcentral.com/office/plansandpricing.html)
* I/My company is an Independent Software Vendor (ISV) who would like to integrate with RingCentral, how do I do that? You can apply to [Join the RingCentral Partner Program](http://www.ringcentral.com/partner/isvreseller.html)


