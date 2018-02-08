<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 12/01/2018
 * Time: 15:34
 */

namespace framework\services;


use framework\modules\configuration\model\Configuration;
use framework\modules\configuration\model\ConfigurationDAO;
use framework\modules\mongoConnection\model\MongoConnection;
use framework\modules\quickstart\model\QuickstartDAO;
use League\Plates\Engine;

//TODO: Refactor service name

class RouteService
{

    /**
     * Loads a controller and executes a given action
     * @param $controllerName string Name of the controller to be loaded
     * @param $actionName string Name of the action to be executed
     * @param bool $isApiCall Specifies if is an api call or not, and should render a page
     * @throws \Exception
     */
    static function Load($controllerName,$actionName,$isApiCall=false)
    {

        //Set for use in catch
        $GLOBALS["isApiCall"] = $isApiCall;

        $subdomain = UrlService::GetSubdomain();

        $enviroments  = ($subdomain == "app")?["app","framework"]:["site"];


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

        $qsDao = new QuickstartDAO();

        if($ControllerClass != "framework\\modules\\quickstart\\controller\\QuickstartController" && count($qsDao->Read([])) == 0)
        {

            //If initial configuration isn't set
            if(!$isApiCall)
            {
               //Redirects to quickstart module

                header("Location: /quickstart");
                exit();
            }
            else
            {
                throw new \Exception("initialConfigNotSet",400);
            }

        }



        $controller = new $ControllerClass($isApiCall);

        $controller->$actionName();



    }


    /**
     * Check if an active configuration exists
     * @param $throwException boolean If is set to true, throws an excepcion, instead of returning the value, in case it's false
     * @return boolean|Configuration
     * @throws \Exception
     */
    static function CheckConfiguration($throwException = false)
    {


        //TODO: make cache of current configuration
        $configurationDao = new ConfigurationDAO();
        $configurations =$configurationDao->Read([]);

        $env  = strtoupper(self::GetEnviroment());
        $currentConfiguration = false;

        foreach ($configurations as $configuration)
        {
                if($configuration["env"] == $env && $configuration["active"] == true)
                {
                    $currentConfiguration = $configuration;
                    break;
                }
        }
        if($throwException && !$currentConfiguration)
        {
            throw new \Exception("configNotLoaded",400);
        }

        return $currentConfiguration;



    }

    /**
     * Gets current enviroment. eg: development
     * @return string
     */
    static function GetEnviroment()
    {
        //TODO: analyze another way to set enviroment than reading it from a plain file
        $env = FileService::ReadFile(ROOT_DIR."/env");
        return trim($env);

    }

    /**
     * Manages exceptions and echoes either the view if isn't an api call or json formatted data
     * @param $code integer Http code
     * @param $data array Data to be processed
     * @return string
     */
    static function LoadHttpCode($code,$data)
    {

        $HttpCodesLangClass  = "app\\modules\\httpCodes\\lang\\HttpCodesLang";
        if(!class_exists($HttpCodesLangClass))
        {
            $HttpCodesLangClass  = "framework\\modules\\httpCodes\\lang\\HttpCodesLang";

        }
        $lang = new $HttpCodesLangClass(LanguageService::detectLanguage());


        http_response_code($code);

        if(!empty($GLOBALS["isApiCall"]))
        {
            if(!empty($data["error"]))
            {
                $data["error"]=$lang->i18n($data["error"]);
            }

            return json_encode($data);
        }
        else
        {
            $httpCodesDir = APP_DIR."modules/httpCodes";

            if(!is_dir($httpCodesDir))
            {
                $httpCodesDir = FRAMEWORK_DIR."modules/httpCodes";
            }



            $tplEngine = new Engine($httpCodesDir."/view","php");

            $tplEngine->addFolder("base",FRAMEWORK_DIR."/modules/base/view");

            $view = (file_exists($httpCodesDir."/view/{$code}.php"))?$code:"default";

            $tplEngine->addData(["lang"=>$lang,"code"=>$code,"bodyClass"=>["error-page",$code]]);

            $template = $tplEngine->make($view);



            return $template->render($data);
        }


    }

    static function MongoConnection()
    {
        $config = self::CheckConfiguration(true);
        $mongoConnection =  new MongoConnection($config["db_name"],$config["db_user"],$config["db_pass"],$config["db_host"],$config["db_port"]);
        return $mongoConnection;

    }



    static function GetHTTPMethod()
    {
        return filter_input( INPUT_SERVER, 'REQUEST_METHOD' );
    }



}