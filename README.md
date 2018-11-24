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
* blogdaren/custom-terminal-color

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
To be supplemented ...... 

## Demostrate
![demo1](https://github.com/blogdaren/Logger/blob/master/Image/demo1.png)
----
![demo2](https://github.com/blogdaren/Logger/blob/master/Image/demo2.png)
----

## Related links and thanks

* [http://www.blogdaren.com](http://www.blogdaren.com)

