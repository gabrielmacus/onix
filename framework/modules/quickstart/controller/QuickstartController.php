<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/01/2018
 * Time: 10:33 AM
 */

namespace framework\modules\quickstart\controller;


use framework\modules\configuration\controller\ConfigurationController;
use framework\modules\configuration\model\Configuration;
use framework\modules\configuration\model\ConfigurationDAO;
use framework\modules\quickstart\lang\QuickstartLang;
use framework\services\LanguageService;


class QuickstartController extends ConfigurationController
{
    function __construct($isApiCall)
    {


        $this->isApiCall = $isApiCall;
        $this->lang  = new QuickstartLang(LanguageService::detectLanguage());
        $this->viewsFolder = FRAMEWORK_DIR."modules/quickstart/view";


        $this->loadTemplates();

        $this->daoArray[] = new ConfigurationDAO() ;
        $this->modelClass="framework\\modules\\configuration\\model\\Configuration";


    }

    /*
    public function create()
    {
        throw new \Exception("actionNotAvailable",404);
    }*/
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