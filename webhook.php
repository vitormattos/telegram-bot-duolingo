<?php
use Telegram\Bot\Api;
require 'vendor/autoload.php';

$telegram = new Api('asdfasdfs');

$response = $telegram->setWebhook('https://telegram-bot-duolingo.appspot.com');
var_dump($response);