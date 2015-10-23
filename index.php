<?php
use Telegram\Bot\Api;
require 'vendor/autoload.php';
require 'config.php';

putenv('DATABASE_URL=http://postgres:postgres@localhost:5432/lupulocalizador');
header("Content-type:image/png");
$ranking = new Commands\RankingCommand();
echo $ranking->handle();
return;

$telegram = new Api($config['token']);

// Standalone
$telegram->addCommands([
    Telegram\Bot\Commands\HelpCommand::class,
    Commands\StartCommand::class,
    Commands\RegisterCommand::class,
    Commands\RankingCommand::class
    
]);

$telegram->commandsHandler(true);
