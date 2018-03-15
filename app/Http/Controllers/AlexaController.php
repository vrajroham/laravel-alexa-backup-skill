<?php

namespace App\Http\Controllers;

use Develpr\AlexaApp\Facades\Alexa;
use Develpr\AlexaApp\Response\AlexaResponse;
use Develpr\AlexaApp\Response\Directives\Dialog\Delegate;
use Develpr\AlexaApp\Response\Reprompt;
use Develpr\AlexaApp\Response\Speech;
use Develpr\AlexaApp\Response\Card;
use Illuminate\Http\Request;
use Log;

class AlexaController extends Controller
{
    /**
     * User defined intent
     * This method is called when user invokes/opens the skill
     * E.g. Alexa, open laravel backup
     * @return Alexa 
     */
    public function start()
    {
    	$message = "Welcome to Laravel Backup. I can help you with taking the backup of code and files. What do you want?";
        return Alexa::say($message)
            ->withCard(new Card('Take a backup', 'You can ask for a backup of code and files to this skill.', $message))
            ->withReprompt(new Reprompt("I didn't understand what you said.  What you would like to do?"))
            ->endSession(false);
    }

    /**
     * Built-in Intent
     * This method is called user says **stop** in between the conversation.
     * @return Alexa
     */
    public function stop()
    {
        $message = "Ok. Have a great day ahead.";
        return Alexa::say($message)->endSession(true);
    }


    /**
     * Built-in Intent
     * This method is called when user asks help for this skill
     * E.g. Alexa, ask laravel backup for help
     * @return Alexa
     */
    public function help()
    {
        $message = "Welcome to Laravel Backup. I can help you with taking the backup of code and files. What do you want?";
        return Alexa::say($message)
            ->withCard(new Card('Take a backup', 'You can ask for a backup of code and files to this skill.', $message))
            ->withReprompt(new Reprompt("I didn't understand what you said.  What you would like to do?"))
            ->endSession(false);
    }

    /**
     * User defined intent
     * This method is called when users asks for Greetings
     * @return Alexa
     */
    public function greetingsIntent()
    {
    	$message = "Welcome to Laravel India";
        return Alexa::say($message);
    }

    /**
     * User defined intent
     * This method is called when user asks for backup
     * E.g. Alexa, ask laravel backup for backup 
     * @return Alexa
     */
    public function backupIntent()
    {
        /**
         * Suppose we want to take a backup of code or database or both and for 
         * same purpose this slots are used. 
         * You can treat slots as variables passed by Alexa to Laravel application.
         */
        if (Alexa::slot('what') != null) {
            //Backup task goes here
            if (Alexa::slot('what') == "database") {
                $exitCode = Artisan::call('backup:run',['--only-db' => true]);
                if ($exitCode == 0) {
                    return Alexa::say("Backup successful. Notification is on the way.");
                }
                else{
                    return Alexa::say("There was a problem in taking backup.");
                }                
            }
        }else{
            /**
             * If user didn't provide the option i.e. code/database/both for backup then,
             * re-prompt user for the options as given below.
             */
            if (array_get(Alexa::request(), 'request.dialogState') == 'STARTED' || array_get(Alexa::request(), 'request.dialogState') == 'IN_PROGRESS') {
                return (new AlexaResponse())->endSession(false)->withDirective(new Delegate());
            }
            return Alexa::say("I didn't understand what you said. Provide an option");
        }
    }
}
