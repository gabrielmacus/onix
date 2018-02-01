<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/01/2018
 * Time: 10:33 AM
 */

namespace framework\modules\quickstart\controller;

use framework\modules\base\controller\BaseController;
use framework\modules\configuration\controller\ConfigurationController;
use framework\modules\configuration\model\ConfigurationDAO;
use framework\modules\quickstart\lang\QuickstartLang;
use framework\services\LanguageService;
use framework\services\RouteService;


class QuickstartController extends BaseController
{
    function __construct($isApiCall)
    {


        $this->isApiCall = $isApiCall;
        $this->lang  = new QuickstartLang(LanguageService::detectLanguage());
        $this->viewsFolder = FRAMEWORK_DIR."modules/quickstart/view";
        $this->loadTemplates();

        $this->daoArray[]=new ConfigurationDAO();


    }


    public function create()
    {

        $step = (!empty($_GET["s"]))?$_GET["s"]:1;


        $configuration= RouteService::CheckConfiguration();

        switch ($step):

            case 1:

              if($configuration)
              {
                header("Location: ".$configuration["app_url"]."quickstart?s=2");
              }
                $_POST["active"]="true";
                $cController = new ConfigurationController($this->isApiCall,[reset($this->daoArray)]);
                $cController->create();


                break;
            case 2:

                break;

        endswitch;



       // throw new \Exception("actionNotAvailable",404);
    }
    public function update()
    {
        throw new \Exception("actionNotAvailable",404);
    }
    public function delete()
    {
        throw new \Exception("actionNotAvailable",404);
    }
    public function index()
    {
        $step = (!empty($_GET["s"]))?$_GET["s"]:1;

        if(!$step || !$this->tplEngine->exists("step-{$step}"))
        {
            throw new \Exception("pageNotFound",404);
        }

        $this->sendResponse([],"step-{$step}");
    }

}