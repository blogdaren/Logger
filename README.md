# Logger

## What is it
A simple and lightful logger for PHP

## Installation
```
composer require blogdaren/logger
```

## Dependencies
* packagist: blogdaren/custom-terminal-color

## Usage

```php
<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
use Logger\Logger;

while(1)
{
    usleep(500000);
    Logger::info('with INFO level');
    Logger::debug('with DEBUG level');
    Logger::warn('with WARNING level');
    Logger::error('with ERROR level');
    Logger::crazy('with CRAZY level');
}
```

## API
1、Available Methods:
```
Logger::show($arg1, $arg2, $arg3, $arg4);
Logger::info($arg1, $arg3, $arg4);
Logger::debug($arg1, $arg3, $arg4);
Logger::warn($arg1, $arg3, $arg4);
Logger::error($arg1, $arg3, $arg4);
Logger::crazy($arg1, $arg3, $arg4);
Logger::disableLogShowWithLevel(['info', 'error']);
Logger::enableLogShowWithLevel(['info', 'error']);
Logger::setLogFile('/tmp/demo.log');
Logger::setDebugMode(true);
```
2、The methods listed above share the same arguments:
```php
* $arg1: message to be logged
* $arg2: log level with 5 options: 
  >> Logger::LOG_LEVEL_INFO
  >> Logger::LOG_LEVEL_DEBUG
  >> Logger::LOG_LEVEL_WARN
  >> Logger::LOG_LEVEL_ERROR
  >> Logger::LOG_LEVEL_CRAZY
* $arg3: determine whether to print log or not, default `NULL`.
* $arg4: where to save log file, default is empty, which means will do nothing.
```

## Demostrate
![demo1](https://github.com/blogdaren/Logger/blob/master/media/demo1.png)
----
![demo2](https://github.com/blogdaren/Logger/blob/master/media/demo2.png)
----

