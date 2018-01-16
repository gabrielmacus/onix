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

        $ControllerClass = "app\\modules\\".$controllerName."\\controller\\".ucfirst($controllerName)."Controller";

        $controller = new $ControllerClass($isApiCall);

        $controller->$actionName();



    }

}