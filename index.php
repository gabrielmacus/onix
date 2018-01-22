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

    $fs = new \framework\modules\fileStorage\model\FileStorage(ROOT_DIR."dmo.json");


    $fs->Delete("5a65040c425ae1.33407332");


    $router = new RouteCollector();
    //TODO: use $_ENV to set route start (replace 'onix')



    /**
     * Create
     */
    $router->post("onix/{controller}/",function ($controllerName){

        \framework\services\RouteService::Load($controllerName,'create');

    });

    $router->post("onix/api/{controller}/",function ($controllerName){

        \framework\services\RouteService::Load($controllerName,'create',true);

    });

    /**
     *
     */

    /**
     * Read
     */


    $router->get("onix/{controller}/",function ($controllerName){


        \framework\services\RouteService::Load($controllerName,"index");

    });


    $router->get("onix/api/{controller}/",function ($controllerName){

        \framework\services\RouteService::Load($controllerName,"index",true);

    });
    /**
     *
     */



    /**
     * Delete
     */

    $router->delete("onix/{controller}/{id}",function ($controllerName,$id){

        $_POST["_id"] = $id;
        \framework\services\RouteService::Load($controllerName,"delete");

    });


    $router->delete("onix/api/{controller}/{id}",function ($controllerName,$id){

        $_POST["_id"] =$id;


        \framework\services\RouteService::Load($controllerName,"delete",true);

    });

    /**
     *
     */

    /**
     * Update
     */

    $router->post("onix/{controller}/{id}",function ($controllerName,$id){

        $_POST["_id"] = $id;
        \framework\services\RouteService::Load($controllerName,"update");

    });


    $router->post("onix/api/{controller}/{id}",function ($controllerName,$id){

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

           echo $e->getMessage();

           break;

       default:
           var_dump($e);
           break;
   }
}