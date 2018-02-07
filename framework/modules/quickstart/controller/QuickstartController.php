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
use framework\modules\configuration\model\Configuration;
use framework\modules\configuration\model\ConfigurationDAO;
use framework\modules\quickstart\lang\QuickstartLang;
use framework\modules\quickstart\model\Quickstart;
use framework\modules\quickstart\model\QuickstartDAO;
use framework\modules\user\controller\UserController;
use framework\services\LanguageService;
use framework\services\RouteService;
use framework\services\UrlService;


class QuickstartController extends BaseController
{
    function __construct($isApiCall)
    {


        $this->isApiCall = $isApiCall;
        $this->lang  = new QuickstartLang(LanguageService::detectLanguage());
        $this->viewsFolder = FRAMEWORK_DIR."modules/quickstart/view";
        $this->loadTemplates();

        $this->daoArray[]=new ConfigurationDAO();

        $this->daoArray[]= new QuickstartDAO();


    }


    public function create()
    {



        $step = (!empty($_GET["s"]))?$_GET["s"]:1;

        $configuration  = $this->checkStepAccess();

        switch ($step):

            case 1:

                $_POST["active"]="true";

                unset($_POST["app_url"]);

                $cController = new ConfigurationController($this->isApiCall,[reset($this->daoArray)]);
                $cController->create();


                break;
            case 2:

                //Creates user
                $uController = new UserController($this->isApiCall );
                $uController->create();

                //Saves quickstart instance, and leaves a record that initial config was set
                $qs = new Quickstart();
                $this->daoArray[1]->Create($qs);


                break;

        endswitch;



       // throw new \Exception("actionNotAvailable",404);
    }


    /**
     * Check if certain step of the quickstart configuration is available. For example,if you didn't complete step 1, you can't go straight to step 2
     * @return void|Configuration
     * @throws \Exception
     */
    private function checkStepAccess()
    {
        $step = (!empty($_GET["s"]))?$_GET["s"]:1;
        $configuration= RouteService::CheckConfiguration();
        switch ($step)
        {
            case 1 :
                //If initial configuration is already set, go to step 1
                if($configuration)
                {
                    if(!$this->isApiCall)
                    {
                        setcookie("step_not_available",$this->lang->i18n("step1NotAvailable"));

                        header("Location: ".UrlService::Join($configuration["app_url"],"quickstart?s=2"));
                        exit();
                    }

                    throw new \Exception($this->lang->i18n("step1NotAvailable"),400);


                }

                break;

            case 2:

                if(count($this->daoArray[1]->Read([])) == 1){

                    if(!$this->isApiCall)
                    {
                        header("Location: /");
                        exit();
                    }

                    throw new \Exception($this->lang->i18n("quickstartAlreadyCompleted"),400);


                }

                if(!$configuration )
                {
                    if(!$this->isApiCall)
                    {
                        setcookie("step_not_available",$this->lang->i18n("step2NotAvailable"));
                        header("Location: ".UrlService::Join($configuration["app_url"],"quickstart?s=1"));
                        exit();
                    }

                    throw new \Exception($this->lang->i18n("step2NotAvailable"),400);

                }


                break;
        }

        return $configuration;
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
        if($this->isApiCall)
        {
            throw new \Exception("actionNotAvailable",404);
        }

        $configuration  = $this->checkStepAccess();
        $step = (!empty($_GET["s"]))?$_GET["s"]:1;

        if(!$step || !$this->tplEngine->exists("step-{$step}"))
        {
            throw new \Exception("pageNotFound",404);
        }

        $this->sendResponse([],"step-{$step}");
    }

}