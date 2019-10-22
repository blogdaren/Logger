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

//e.g try to disable `error` option to prevent error log to be shown  
Logger::disableOption(['error']);


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
        Logger::enableOption(['error']);
    }
}
