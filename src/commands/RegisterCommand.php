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

        $this->replyWithMessage(print_r($this->telegram->getLastResponse(), true));
        return;
        if(!$arguments) {
            $this->replyWithMessage('Enter your duolingo username, example:');
            $this->replyWithMessage('/register MyUsername');
        } else {
            $profile = json_decode(file_get_contents('https://www.duolingo.com/users/'.$arguments));
            if($profile) {
//                 $db = DB::getInstance();
//                 $db->perform(
//                     "INSERT INTO users (username) VALUES (:username)",
//                     [
//                         'username' => $profile->username
//                     ]
//                 );
                $this->replyWithMessage('Welcome '.($profile->fullname?:$profile->username).'!');
            } else {
                $this->replyWithMessage('Invalid username');
            }
        }
    }
}