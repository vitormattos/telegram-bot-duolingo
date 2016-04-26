<?php
use Telegram\Bot\Api;
use Commands;
require 'vendor/autoload.php';
require 'config.php';

if(getenv('MODE_ENV') == 'develop') {
    class mockApi extends Api{
        public function getWebhookUpdates() {
            $json = '{}';
            return new Telegram\Bot\Objects\Update(json_decode($json, true));
        }
    }
    $telegram = new mockApi($config['token']);
} else {
    error_log(file_get_contents('php://input'));
    $telegram = new Api($config['token']);
}

// Standalone
$telegram->addCommands([
    Telegram\Bot\Commands\HelpCommand::class,
    Commands\StartCommand::class,
    Commands\RegisterCommand::class,
    Commands\RemoveCommand::class,
    Commands\RankingCommand::class,
    Commands\ListUsersCommand::class
]);

$telegram->commandsHandler(true);