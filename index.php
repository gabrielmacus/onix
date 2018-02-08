<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 19:48
 */

use Phroute\Phroute\RouteCollector;

try
{
    include "init.php";
     $router = new RouteCollector();

    /**
     * Create
     */
    $router->post("{controller}/",function ($controllerName){

        \framework\services\RouteService::Load($controllerName,'create');

    });

    $router->post("api/{controller}/",function ($controllerName){

        \framework\services\RouteService::Load($controllerName,'create',true);

    });

    /**
     *
     */

    /**
     * Read
     */


    $router->get("{controller}/",function ($controllerName){


        \framework\services\RouteService::Load($controllerName,"index");

    });


    $router->get("api/{controller}/",function ($controllerName){

        \framework\services\RouteService::Load($controllerName,"index",true);

    });
    /**
     *
     */



    /**
     * Delete
     */

    $router->delete("{controller}/{id}",function ($controllerName,$id){

        $_POST["_id"] = $id;
        \framework\services\RouteService::Load($controllerName,"delete");

    });


    $router->delete("api/{controller}/{id}",function ($controllerName,$id){

        $_POST["_id"] =$id;


        \framework\services\RouteService::Load($controllerName,"delete",true);

    });

    /**
     *
     */

    /**
     * Update
     */

    $router->post("{controller}/{id}",function ($controllerName,$id){

        $_POST["_id"] = $id;
        \framework\services\RouteService::Load($controllerName,"update");

    });


    $router->post("api/{controller}/{id}",function ($controllerName,$id){


        $_POST["_id"] =$id;


        \framework\services\RouteService::Load($controllerName,"update",true);

    });
    /**
     *
     */



    /**
     * Other actions
     */

    $router->any("{controller}/{action}",function ($controllerName,$actionName){

        \framework\services\RouteService::Load($controllerName,$actionName);


    });

    $router->any("api/{controller}/{action}",function ($controllerName,$actionName){

        \framework\services\RouteService::Load($controllerName,$actionName,true);
    });








# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());


    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Print out the value returned from the dispatched function
    echo $response;


}
catch (Exception $e)
{

    \framework\services\DebugService::ExceptionHandler($e);

}