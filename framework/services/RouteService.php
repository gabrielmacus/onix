<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 12/01/2018
 * Time: 15:34
 */

namespace framework\services;


class RouteService
{

    static function Load($controllerName,$actionName,$isApiCall=false)
    {


        // Controller class

        $ControllerClass = (class_exists("app\\modules\\".$controllerName."\\controller\\".ucfirst($controllerName)."Controller"))?"app\\modules\\".$controllerName."\\controller\\".ucfirst($controllerName)."Controller":"framework\\modules\\".$controllerName."\\controller\\".ucfirst($controllerName)."Controller";


        if(!class_exists($ControllerClass))
        {
            throw  new \Exception("moduleNotFound",404);
        }

        $controller = new $ControllerClass($isApiCall);

        $controller->$actionName();



    }

}