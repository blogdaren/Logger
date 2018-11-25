<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
use Logger\Logger;

while(1)
{
    usleep(500000);
    Logger::showInfo('with INFO level');
    Logger::showDebug('with DEBUG level');
    Logger::showWarning('with WARNING level');
    Logger::showError('with ERROR level');
    Logger::showCrazy('with CRAZY level');
}
