<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 21:56
 */

namespace framework\modules\base\controller;

use framework\modules\base\lang\BaseLang;
use framework\modules\mongoConnection\model\MongoConnection;
use framework\services\LanguageService;
use framework\services\ModuleService;
use League\Plates\Engine;

class BaseController
{

    //TODO: delete $modelClass. This is because i can detect the models i need from the $daoArray, using ModuleService
    protected $isApiCall;
    protected $daoArray;
    protected $viewsFolder;
    protected $modelClass;
    protected $lang;
    /**
     * Templates engine. Current base on php plates
     * @see http://platesphp.com/v3/engine/
     * @var
     */
    protected $tplEngine;

    /**
     * @deprecated
     * BaseController constructor.
     * @param $isApiCall  bool   Indicates if is an api call, or a call to the view
     * @param $daoArray  array  Data Access Objects that will be used in the controller. As default, in BaseController, the first DAO in array is used
     * @param $modelClass string Model Class that will be used in the controller
     * @param $lang BaseLang Language object that has a dictionary with words references in the user language
     * @param $viewsFolder string Folder where the templates are stored
     */
    public function old__construct(array $daoArray,$isApiCall = false,$modelClass,$viewsFolder,BaseLang $lang)
    {
        $this->isApiCall = $isApiCall;
        $this->daoArray = $daoArray;
        $this->modelClass = $modelClass;
        $this->lang = $lang;

        if(!empty($viewsFolder) && is_dir($viewsFolder))
        {
            $this->viewsFolder = $viewsFolder;
        }
        else
        {
            //If no views folder is specified or doesn't exist, base views folder is set
            $this->viewsFolder = FRAMEWORK_DIR."modules/base/view";
        }
    }

    /**
     *
     * BaseController constructor.
     * @param $isApiCall  bool   Indicates if is an api call, or a call to the view
     * @param $daoArray  array  Data Access Objects that will be used in the controller. As default, in BaseController, the first DAO in array is used
     * @param $modelClass string Model Class that will be used in the controller
     * @param $lang LanguageService Language object that has a dictionary with words references in the user language
     * @param $viewsFolder string Folder where the templates are stored
     */
    function __construct($isApiCall = null,$daoArray = null,LanguageService $lang = null,$modelClass=null,$viewsFolder=null)
    {
        if(empty($daoArray))
        {
            //TODO: load database access from config
            $daoClass = ModuleService::GetModuleModelDAO($this);
            $mongoConnection =  new MongoConnection("onix");
            $dao = new $daoClass($mongoConnection);
            $daoArray = [$dao];


        }

        if(empty($modelClass))
        {
            $modelClass = ModuleService::GetModuleModel($this);
        }

        if(empty($viewsFolder))
        {

            $viewsFolder = ModuleService::GetModuleView($this);
        }

        if(empty($lang))
        {
            $langClass = ModuleService::GetModuleLang($this);
            $lang = new $langClass(LanguageService::detectLanguage());

        }

        $this->isApiCall = $isApiCall;
        $this->daoArray = $daoArray;
        $this->modelClass = $modelClass;
        $this->lang = $lang;

        if(!empty($viewsFolder) && is_dir($viewsFolder))
        {
            $this->viewsFolder = $viewsFolder;
        }
        else
        {
            //If no views folder is specified or doesn't exist, base views folder is set
            $this->viewsFolder = FRAMEWORK_DIR."modules/base/view";
        }

        $this->loadTemplates();
    }


    /**
     * Loads the templates to be used. Should be called before using them, preferentially in __construct
     */
    public function loadTemplates()
    {
        $this->tplEngine = new Engine($this->viewsFolder,'php');

        //TODO: load parent folder templates

        $this->tplEngine->addFolder("base",FRAMEWORK_DIR."/modules/base/view");

        $this->tplEngine->addFolder("components",FRAMEWORK_DIR."/modules/gui-components/view");

        //TODO: may be i can scan the views folder to add template folders
    }

    public function index()
    {
        $dao = reset($this->daoArray);

        $filter = (!empty($_GET["filter"]) && is_array($_GET["filter"]))?$_GET["filter"]:[];

        $results = $dao->read($filter);

        $ModelClass = $this->modelClass;
        $ModelClass::PrintSerializeArray($results,$this->lang);

        $this->sendResponse(["results"=>$results],"list");

    }

    public function create()
    {
        $dao = reset($this->daoArray);

        $model = new $this->modelClass ();

        $model = $model->ObjectFromArray($_POST);

        $dao->Create($model);

        $model =$model->printSerialize($this->lang);



        $this->sendResponse(["results"=>$model]);


    }

    public function update()
    {
        $dao = reset($this->daoArray);

        $model = new $this->modelClass ();

        $model = $model->ObjectFromArray($_POST);


        $response = $dao->Update($model);

        $response =  $response->printSerialize($this->lang);


        $this->sendResponse(["results"=>$response]);
    }

    public function delete(){

        $dao = reset($this->daoArray);


       // $id = (!empty($_POST["_id"]))? new \MongoId($_POST["_id"]):false;
        $id = (!empty($_POST["_id"]))? $_POST["_id"]:false;

        //If the id is Mongo uuid or not
        $id = (\MongoId::isValid($id))?new \MongoId($id):$id;

        $dao->Delete($id);

        $this->sendResponse([]);

    }


    public function sendResponse($response,$view=false)
    {
         if($this->isApiCall)
        {

            echo json_encode($response);
        }
        elseif($view)
        {
            $tplEngine = $this->tplEngine;

            $template = $tplEngine->make("{$view}");

            $response["bodyClass"][] = ModuleService::GetModule($this);



            $response["lang"] = $this->lang;


            echo $template->render($response);

        }
    }



}