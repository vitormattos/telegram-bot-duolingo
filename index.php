<?php
$dbh = new PDO('sqlite:duolingo.sqlite');

use Telegram\Bot\Api;
require 'vendor/autoload.php';

$telegram = new Api('asdfadf');

// Standalone
$telegram->addCommands([
    Telegram\Bot\Commands\HelpCommand::class,
    Commands\StartCommand::class,
    Commands\RegisterCommand::class
]);

$telegram->commandsHandler(true);