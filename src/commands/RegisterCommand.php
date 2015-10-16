<?php
namespace Commands;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Actions;

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
                $this->replyWithMessage('Welcome '.($profile->fullname?:$profile->username).'!');
            } else {
                $this->replyWithMessage('Invalid username');
            }
        }
    }
}