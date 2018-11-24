<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
use Logger\Logger;

while(1)
{
    usleep(500000);
    Logger::show('with info level', Logger::LOG_LEVEL_INFO);
    Logger::show('with debug level', Logger::LOG_LEVEL_DEBUG);
    Logger::show('with warning level', Logger::LOG_LEVEL_WARN);
    Logger::show('with error level', Logger::LOG_LEVEL_ERROR);
    Logger::show('with crazy level', Logger::LOG_LEVEL_CRAZY);
}
