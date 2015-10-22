<?php
namespace Commands;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Actions;
use Base\DB;

class RegisterCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "register";

    /**
     * @var string Command Description
     */
    protected $description = "Register your duolingo username in this group";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        // This will update the chat status to typing...
        $this->replyWithChatAction(Actions::TYPING);

        if(!$arguments) {
            $this->replyWithMessage('Enter your duolingo username, example:');
            $this->replyWithMessage('/register MyUsername');
        } else {
            $profile = json_decode(file_get_contents('https://www.duolingo.com/users/'.$arguments));
            if($profile) {
                $message = $this->telegram->getWebhookUpdates()->all()->mesage;

                $dbopts = parse_url(getenv('DATABASE_URL'));
                $this->replyWithMessage(print_r($dbopts, true));
                $db = new ExtendedPdo([
                    "pgsql:host={$dbopts["host"]};port={$dbopts["port"]};dbname=".ltrim($dbopts["path"],'/'),
                    $dbopts['user'],
                    $dbopts['pass']
                    ]);
                $this->replyWithMessage(print_r($db, true))
//                 $db = DB::getInstance();
//                 $db->perform(
//                     "INSERT INTO users (username) VALUES (:username, :registered_by, :date)",
//                     [
//                         'username'      => $profile->username,
//                         'registered_by' => $message['from']['id'],
//                         'date' => date('Y-m-d H:i:s', $message['date'])
//                     ]
//                 );
//                 $this->replyWithMessage('Welcome '.($profile->fullname?:$profile->username).'!');
            } else {
                $this->replyWithMessage('Invalid username');
            }
        }
    }
}