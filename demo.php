<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
use Logger\Logger;

while(1)
{
    usleep(500000);
    Logger::info('with INFO level');
    Logger::debug('with DEBUG level');
    Logger::warning('with WARNING level');
    Logger::error('with ERROR level');
    Logger::crazy('with CRAZY level');
}
