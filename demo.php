<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
use Logger\Logger;


//try to disable LOG_LEVEL_ERROR option
Logger::disableOption([
    Logger::LOG_LEVEL_ERROR,
]);


$now_time = time();
while(1)
{
    usleep(500000);
    Logger::info('with INFO level');
    Logger::debug('with DEBUG level');
    Logger::warning('with WARNING level');
    Logger::crazy('with CRAZY level');
    Logger::error('with ERROR level');

    // try to re-enable LOG_LEVEL_ERROR option
    if(time() - $now_time > 1)
    {
        Logger::enableOption([
            Logger::LOG_LEVEL_ERROR,
        ]);
    }
}
