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

