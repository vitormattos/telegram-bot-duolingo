<?php
use Telegram\Bot\Api;
use Commands;
require 'vendor/autoload.php';
require 'config.php';

if(getenv('MODE_ENV') == 'develop') {
    class mockApi extends Api{
        public function getWebhookUpdates() {
            $json = '{"update_id":143180525,"message":{"message_id":4035,"from":{"id":77489131,"first_name":"[\u0332\u0305\u0454\u0332\u0305l\u0332\u0305i\u0332\u0305\u03b1\u0332\u0305\u0e23\u0332\u0305 \u0332\u0305\u0438\u0332\u0305\u03c5\u0332\u0305\u0438\u0332\u0305\u0454\u0332\u0305\u0e23\u0332\u0305]","last_name":"@\u0192\u03c3s\u0142\u03c3ks","username":"Fosloks"},"chat":{"id":-1001015655887,"title":"Duolingo","username":"duolingogroup","type":"supergroup"},"date":1461644147,"text":"\/ranking@duolingoclass_bot","entities":[{"type":"bot_command","offset":0,"length":26}]}}';
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