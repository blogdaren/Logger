<?php
/**
 * @script   demo.php
 * @brief    just a demo
 * @author   blogdaren<blogdaren@163.com>
 * @version  1.0.0
 * @modify   2019-10-23
 */

require_once dirname(__FILE__) . '/vendor/autoload.php';
use Logger\Logger;

//try to disable `error` log level to prevent it to be shown
Logger::disableLogShowWithLevel(['error']);

//set log file: 
//1. do nth when keep empty, or put logs into the file given
//2. note that nested directory will be created automatically 
Logger::setLogFile('/tmp/logs/user/cash/demo.log');

//set debug mode: default as `true`
Logger::setDebugMode(true);

$now_time = time();
while(1)
{
    usleep(500000);
    Logger::info('with INFO level');
    Logger::debug('with DEBUG level');
    Logger::warn('with WARNING level');
    Logger::crazy('with CRAZY level');
    Logger::error('with ERROR level');

    //try to re-enable 'error' log level to be shown
    if(time() - $now_time > 1)
    {
        Logger::enableLogShowWithLevel(['error']);
    }
}


