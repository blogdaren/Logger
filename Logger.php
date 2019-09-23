<?php
/**
 * @script   Base.php
 * @brief    This file is part of PHPForker
 * @author   blogdaren<blogdaren@163.com>
 * @link     http://www.blogdaren.com
 * @version  1.0.0
 * @modify   2018-10-11
 */

namespace Logger;

use CustomTerminalColor\Color;
use Exception;

class Logger
{
    /**
     * container version
     *
     * @var string
     */
    const VERSION = '1.0.8';

    /**
     * log level code for debuging mode
     *
     * @var int
     */
    const LOG_LEVEL_DEBUG   = 1;

    /**
     * log level code for info mode
     *
     * @var int
     */
    const LOG_LEVEL_INFO    = 2;

    /**
     * log level code for warning mode
     *
     * @var int
     */
    const LOG_LEVEL_WARN    = 3;

    /**
     * log level code for error mode
     *
     * @var int
     */
    const LOG_LEVEL_ERROR   = 4;

    /**
     * log level code for crazy mode
     *
     * @var int
     */
    const LOG_LEVEL_CRAZY   = 5;

    /**
     * debug
     *
     * @var string
     */
    static  public  $debug = true;

    /**
     * log file
     *
     * @var string
     */
    static  public  $logFile = '';

    /**
     * we can custom the message prefix
     *
     * @var string
     */
    static  public  $msgPrefix = '';

    /**
     * standard output stream
     *
     * @var resource
     */
    static  protected	$_outputStream	    = null;

    /**
     * $outputStream is decorated or not
     *
     * @var boolean
     */
    static  protected	$_outputDecorated   = false;

    /**
     * determine whether the log to be shown or not
     *
     * @var array 
     */
    static  public  $option = array(
        self::LOG_LEVEL_INFO    => 1,
        self::LOG_LEVEL_DEBUG   => 1,
        self::LOG_LEVEL_WARN    => 1,
        self::LOG_LEVEL_ERROR   => 1,
        self::LOG_LEVEL_CRAZY   => 1,
    );

    /**
     * @brief    safeEcho
     *
     * @param    string  $msg
     * @param    string  $show_colorful
     *
     * @return   boolean
     */
    static public function safeEcho($msg, $show_colorful = true)
    {
        $stream = self::setOutputStream();
        if(!$stream) return false;

        if($show_colorful) 
        {
            $line = $white = $yellow = $red = $green = $blue = $skyblue = $end = '';
            if(self::$_outputDecorated) 
            {
                $line    =  "\033[1A\n\033[K";
                $white   =  "\033[47;30m";
                $yellow  =  "\033[1m\033[33m";
                $red     =  "\033[1m\033[31m";
                $green   =  "\033[1m\033[32m";
                $blue    =  "\033[1m\033[34m";
                $skyblue =  "\033[1m\033[36m";
                $ry      =  "\033[1m\033[41;33m";
                $ul      =  "\033[1m\033[4m\033[36m";
                $end     =  "\033[0m";
            }

            $color = array($line, $white, $green, $yellow, $skyblue, $red, $blue, $ry, $ul);
            $msg = str_replace(array('<n>', '<w>', '<g>', '<y>', '<s>', '<r>', '<b>', '<t>', '<u>'), $color, $msg);
            $msg = str_replace(array('</n>', '</w>', '</g>', '</y>', '</s>', '</r>', '</b>', '</t>', '</u>'), $end, $msg);
        } 
        elseif(!self::$_outputDecorated) 
        {
            return false;
        }

        fwrite($stream, $msg);
        fflush($stream);

        return true;
    }

    /**
     * @brief    setOutputStream
     *
     * @param    string  $stream
     *
     * @return   boolean
     */
    static private function setOutputStream($stream = null)
    {
        if(!$stream) 
        {
            $stream = self::$_outputStream ? self::$_outputStream : STDOUT;
        }

        if(!$stream || !is_resource($stream) || 'stream' !== get_resource_type($stream)) 
        {
            return false;
        }

        $stat = fstat($stream);

        if(($stat['mode'] & 0170000) === 0100000) {
            self::$_outputDecorated = false;
        } else {
            self::$_outputDecorated = function_exists('posix_isatty') && posix_isatty($stream);
        }

        return self::$_outputStream = $stream;
    }

    /**
     * @brief    logger    
     *
     * @param    string  $msg       
     * @param    string  $level     DEBUG|INFO|WARN|ERROR|CRAZY
     *
     * @return   void
     */
    static private function _log($msg, $level = self::LOG_LEVEL_INFO)
    {
        if(!is_numeric($msg) && !is_string($msg)) return;

        $log_level = self::getLogLevel($level);
        $log_level = str_pad($log_level, 5, ' ', STR_PAD_RIGHT);
        list($ts, $ms) = explode(".", sprintf("%f", microtime(true)));
        $time = date("Y-m-d H:i:s") . "." . str_pad($ms, 6, 0);
        $prefix = "$time | $log_level | ";
        $msg = $prefix . self::$msgPrefix . $msg . PHP_EOL;

        self::$logFile && file_put_contents((string)self::$logFile, $msg, FILE_APPEND | LOCK_EX);

        //show colorful text by level 
        $level == self::LOG_LEVEL_INFO  && $msg = Color::getColorfulText($msg, 'white', 'black');
        $level == self::LOG_LEVEL_DEBUG && $msg = Color::getColorfulText($msg, 'black', 'green');
        $level == self::LOG_LEVEL_WARN  && $msg = Color::getColorfulText($msg, 'black', 'yellow');
        $level == self::LOG_LEVEL_ERROR && $msg = Color::getColorfulText($msg, 'white', 'red');
        $level == self::LOG_LEVEL_CRAZY && $msg = Color::getColorfulText($msg, 'white', 'blue');

        //only show in DEBUG mode
        true === self::$debug && self::safeEcho($msg);
    }

    /**
     * @brief    logger    
     *
     * @param    string  $msg       
     * @param    string  $level     DEBUG|INFO|WARN|ERROR|CRAZY
     *
     * @return   void
     */
    static public function show($msg, $level = self::LOG_LEVEL_INFO, $debug = true, $log_file = '/tmp/default.log')
    {
        //check option
        if(0 == self::$option[$level]) return;

        //if("linux" != strtolower(PHP_OS)) throw new Exception('only support LINUX currently......');
        if("linux" != strtolower(PHP_OS)) $logFile = 'C:\\default.log'; 

        self::$debug = $debug === true ? true : false;
        self::$logFile = $log_file;

        if(!empty(self::$logFile))
        {
            if(!is_file(self::$logFile))
            {
                @touch(self::$logFile);
                @chmod(self::$logFile, 0755);
            }

            if(!file_exists(self::$logFile))  throw new Exception('invalid log file path......');
        }

        return self::_log($msg, $level);
    }

    /**
     * @brief    info   
     *
     * @param    string  $msg
     * @param    boolean $debug
     * @param    string  $log_file
     *
     * @return   string
     */
    static public function info($msg = '', $debug = true, $log_file = '/tmp/default.log')
    {
        return self::show($msg, self::LOG_LEVEL_INFO, $debug, $log_file);
    }

    /**
     * @brief    debug  
     *
     * @param    string  $msg
     * @param    boolean $debug
     * @param    string  $log_file
     *
     * @return   string
     */
    static public function debug($msg = '', $debug = true, $log_file = '/tmp/default.log')
    {
        return self::show($msg, self::LOG_LEVEL_DEBUG, $debug, $log_file);
    }

    /**
     * @brief    warning    
     *
     * @param    string  $msg
     * @param    boolean $debug
     * @param    string  $log_file
     *
     * @return   string
     */
    static public function warning($msg = '', $debug = true, $log_file = '/tmp/default.log')
    {
        return self::show($msg, self::LOG_LEVEL_WARN, $debug, $log_file);
    }

    /**
     * @brief    error  
     *
     * @param    string  $msg
     * @param    boolean $debug
     * @param    string  $log_file
     *
     * @return   string
     */
    static public function error($msg = '', $debug = true, $log_file = '/tmp/default.log')
    {
        return self::show($msg, self::LOG_LEVEL_ERROR, $debug, $log_file);
    }

    /**
     * @brief    crazy  
     *
     * @param    string  $msg
     * @param    boolean $debug
     * @param    string  $log_file
     *
     * @return   string 
     */
    static public function crazy($msg = '', $debug = true, $log_file = '/tmp/default.log')
    {
        return self::show($msg, self::LOG_LEVEL_CRAZY, $debug, $log_file);
    }

    /**
     * @brief    getLogLevel    
     *
     * @param    string  $level
     *
     * @return   string
     */
    static public function getLogLevel($level)
    {
        switch ($level) {
            case self::LOG_LEVEL_DEBUG:
                $log_level = 'DEBUG';
                break;
            case self::LOG_LEVEL_INFO:
                $log_level = 'INFO';
                break;
            case self::LOG_LEVEL_WARN:
                $log_level = 'WARN';
                break;
            case self::LOG_LEVEL_ERROR:
                $log_level = 'ERROR';
                break;
            case self::LOG_LEVEL_CRAZY:
                $log_level = 'CRAZY';
                break;
            default:
                $log_level = 'INFO';
                break;
        }

        return $log_level;
    }

    /**
     * @brief    set the message prefix
     *
     * @return   null
     */
    static public function setMessagePrefix($prefix = '')
    {
        if(!is_string($prefix)) return;

        !empty($prefix) && self::$msgPrefix = $prefix . ' | ';
    }

    /**
     * @brief    disable some option to determine which log level shoud not be shown
     *
     * @param    string|array  $levels
     *
     * @return   null
     */
    static public function disableOption($levels = '')
    {
        if(empty($levels)) return;

        !is_array($levels) && $levels = array($levels);

        foreach($levels as $level)
        {
            $level = strtoupper($level);
            if(!array_key_exists($level, self::$option)) continue;
            self::$option[$level] = 0;
        }
    }

    /**
     * @brief    enable some option to determine which log level shoud be shown
     *
     * @param    string|array  $levels
     *
     * @return   null
     */
    static public function enableOption($levels = '')
    {
        if(empty($levels)) return;

        !is_array($levels) && $levels = array($levels);

        foreach($levels as $level)
        {
            $level = strtoupper($level);
            if(!array_key_exists($level, self::$option)) continue;
            self::$option[$level] = 1;
        }
    }
}

