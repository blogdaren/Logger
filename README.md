# Logger

## What is it
A simple and lightful logger for PHP

## Logger是什么
一个简洁的、轻量级的PHP日志工具

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
    Logger::showInfo('with INFO level');
    Logger::showDebug('with DEBUG level');
    Logger::showWarning('with WARNING level');
    Logger::showError('with ERROR level');
    Logger::showCrazy('with CRAZY level');
}
```

## Usage
1、Available Method:
```
Logger::show($arg1, $arg2, $arg3, $arg4);
Logger::showInfo($arg1, $arg3, $arg4);
Logger::showDebug($arg1, $arg3, $arg4);
Logger::showWarning($arg1, $arg3, $arg4);
Logger::showError($arg1, $arg3, $arg4);
Logger::showCrazy($arg1, $arg3, $arg4);
```
2、The method listed above share the same arguments:
```php
* $arg1: message to be logged
* $arg2: log level with 5 options: 
  >> Logger::LOG_LEVEL_INFO
  >> Logger::LOG_LEVEL_DEBUG
  >> Logger::LOG_LEVEL_WARN
  >> Logger::LOG_LEVEL_ERROR
  >> Logger::LOG_LEVEL_CRAZY
* $arg3: whether to print log or not on terminal, default `true`
* $arg4: where to store log file, default `/tmp/default.log`
```

## Demostrate
![demo1](https://github.com/blogdaren/Logger/blob/master/media/demo1.png)
----
![demo2](https://github.com/blogdaren/Logger/blob/master/media/demo2.png)
----

## Related links and thanks

* [http://www.blogdaren.com](http://www.blogdaren.com)

