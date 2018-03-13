<?php

// Called when you say "Alexa, open laravel backup"
AlexaRoute::launch('/alexa', '\App\Http\Controllers\AlexaController@start');

// To close connection with server
 AlexaRoute::sessionEnded('/alexa', function () {
     return '{"version":"1.0","response":{"shouldEndSession":true}}';
 });

//Called when you ask for greetings. E.g. Alexa ask, laravel backup to greet us
AlexaRoute::intent('/alexa', 'GreetingsIntent', '\App\Http\Controllers\AlexaController@greetingsIntent');

//Called when you ask to stop any conversation
AlexaRoute::intent('/alexa', 'AMAZON.StopIntent', '\App\Http\Controllers\AlexaController@stop');

//Called when you ask for help related to current skill. E.g. Alexa, ask laravel backup for help
AlexaRoute::intent('/alexa', 'AMAZON.HelpIntent', '\App\Http\Controllers\AlexaController@help');

//Called when you ask for backup. E.g. Alexa, ask laravel backup to take a backup
AlexaRoute::intent('/alexa', 'BackupIntent', '\App\Http\Controllers\AlexaController@backupIntent');