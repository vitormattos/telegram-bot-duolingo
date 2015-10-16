<?php
use Telegram\Bot\Api;
require 'config.php';

$telegram = new Api($config['token']);

$response = $telegram->setWebhook('https://telegram-bot-duolingo.appspot.com');
var_dump($response);
