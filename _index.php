<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 19:48
 */
include "autoload.php";
use Phroute\Phroute\RouteCollector;

try
{

    $router = new RouteCollector();

    function index ($controllerName,$id=false,$isApiCall=false){


        $connection  = new \framework\modules\mongoConnection\model\MongoConnection("onix");

        $DaoClass = "app\\modules\\".$controllerName."\\model\\".ucfirst($controllerName)."DAO";

        $dao = new $DaoClass($connection);

        $ControllerClass ="app\\modules\\".$controllerName."\\controller\\".ucfirst($controllerName)."Controller";

        $viewsFolder = APP_DIR."modules/{$controllerName}/view";

        $controller =  new $ControllerClass([$dao],$isApiCall,$viewsFolder);

        $_GET["filter"]=["_type"=> "app\\modules\\".$controllerName."\\model\\".ucfirst($controllerName)];

        $langClass = "app\\modules\\".$controllerName."\\lang\\".ucfirst($controllerName)."Lang";

        $lang = new $langClass("es");


        if($id)
        {
            $_GET["filter"]["_id"] =  new MongoId($id);
        }
        $controller->index();


    }   $router->get('onix/api/{controller}/',function ($controllerName){

    index($controllerName,false,true);

});
    $router->get('onix/api/{controller}/{id}',function ($controllerName,$id){


        index($controllerName,$id,true);

    });


    $router->get('onix/{controller}/',"index");

    $router->get('onix/{controller}/{id}',"index");






    $router->post('onix/api/{controller}',function ($controllerName){

        $connection  = new \framework\modules\mongoConnection\model\MongoConnection("onix");

        $DaoClass = "app\\modules\\".$controllerName."\\model\\".ucfirst($controllerName)."DAO";

        $dao = new $DaoClass($connection);

        $ControllerClass ="app\\modules\\".$controllerName."\\controller\\".ucfirst($controllerName)."Controller";

        $_GET["model"] =     $DaoClass = "app\\modules\\".$controllerName."\\model\\".ucfirst($controllerName);

        $controller =  new $ControllerClass([$dao],true);

        $controller->create();


    });








# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());


    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Print out the value returned from the dispatched function
    echo $response;


}
catch (Exception $e)
{
    var_dump($e);
}