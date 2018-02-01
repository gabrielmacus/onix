<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 19:48
 */
include "init.php";
use Phroute\Phroute\RouteCollector;


try
{


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


# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());


    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Print out the value returned from the dispatched function
    echo $response;


}
catch (Exception $e)
{

    http_response_code($e->getCode());

   switch (true)
   {
       case (is_a($e,"\\framework\\modules\\base\\exception\\ValidationException")):

           $r = ["validation"=>true,"errors"=>json_decode($e->getMessage(),true)];
           echo json_encode($r);

           break;

       default:
           var_dump($e);
           break;
   }
}