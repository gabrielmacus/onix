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

        $enviroments = ["app","framework","site"];

        foreach ($enviroments as $enviroment)
        {

            if(class_exists($enviroment."\\modules\\".$controllerName."\\controller\\".ucfirst($controllerName)."Controller"))
            {
                $ControllerClass = $enviroment."\\modules\\".$controllerName."\\controller\\".ucfirst($controllerName)."Controller";
                break;
            }

        }

        if(empty($ControllerClass))
        {
            throw  new \Exception("moduleNotFound",404);

        }




        $controller = new $ControllerClass($isApiCall);

        $controller->$actionName();



    }

}