<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 23:06
 */




include "vendor/autoload.php";

define("ROOT_DIR",dirname(__FILE__)."/");

define("FRAMEWORK_DIR",ROOT_DIR."framework/");

define("APP_DIR",ROOT_DIR."app/");

define("SITE_DIR",ROOT_DIR."site/");




function class_autoload($class)
{
    $path =  ROOT_DIR.$class.".php";


    if(file_exists($path))
    {
        include_once $path;
    }

}

spl_autoload_register('class_autoload');


function errorHandler($errno, $errstr, $errfile, $errline) {

    $data["errno"] = $errno;
    $data["message"] = $errstr;
    $data["file"] = $errfile;
    $data["line"] = $errline;


    if(strtoupper(\framework\services\RouteService::GetEnviroment()) == "DEVELOPMENT")
    {
        $data["time"] = \framework\services\TimeService::now();
        $data["backtrace"] = debug_backtrace();;
        \framework\services\FileService::SaveData(APP_DIR."log/error.log",json_encode($data)."\n",true);
    }



    \framework\services\DebugService::ExceptionHandler( new \framework\modules\base\exception\HandledError(json_encode($data),500));

}

function shutdownHandler()
{
    $lasterror = error_get_last();

    switch ($lasterror['type'])
    {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_PARSE:
        if(strtoupper(\framework\services\RouteService::GetEnviroment()) == "DEVELOPMENT")
        {
            $lasterror["time"] = \framework\services\TimeService::now();
            $lasterror["backtrace"] = debug_backtrace();
              \framework\services\FileService::SaveData(APP_DIR."log/error.log",json_encode($lasterror)."\n",true);
        }

        \framework\services\DebugService::ExceptionHandler(new \framework\modules\base\exception\HandledError(json_encode($lasterror),500));
    }
}
// Set user-defined error handler function
set_error_handler("errorHandler");
register_shutdown_function("shutdownHandler");
ini_set( "display_errors", "off" );
error_reporting( E_ALL );