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
    Logger::show('with info level', Logger::LOG_LEVEL_INFO);
    Logger::show('with debug level', Logger::LOG_LEVEL_DEBUG);
    Logger::show('with warning level', Logger::LOG_LEVEL_WARN);
    Logger::show('with error level', Logger::LOG_LEVEL_ERROR);
    Logger::show('with crazy level', Logger::LOG_LEVEL_CRAZY);
}
```

## Usage
```php
Logger::show($arg1, $arg2, $arg3, $arg4);
* $arg1: message to be logged
* $arg2: log level with 5 options: 
(1) Logger::LOG_LEVEL_INFO
(2) Logger::LOG_LEVEL_DEBUG
(3) Logger::LOG_LEVEL_WARN
(4) Logger::LOG_LEVEL_ERROR
(5) Logger::LOG_LEVEL_CRAZY
* $arg3: whether to print log or not on terminal
* $arg4: where to store log file
```

## Demostrate
![demo1](https://github.com/blogdaren/Logger/blob/master/media/demo1.png)
----
![demo2](https://github.com/blogdaren/Logger/blob/master/media/demo2.png)
----

## Related links and thanks

* [http://www.blogdaren.com](http://www.blogdaren.com)

