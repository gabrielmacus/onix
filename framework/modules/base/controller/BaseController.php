<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 21:56
 */

namespace framework\modules\base\controller;


use Dwoo\Core;
class BaseController
{

    protected $isApiCall;
    protected $daoArray;
    protected $viewsFolder;
    protected $modelClass;
    protected $langArray;

    /**
     * BaseController constructor.
     * @param $isApiCall  bool   Indicates if is an api call, or a call to the view
     * @param $daoArray  array  Data Access Objects that will be used in the controller. As default, in BaseController, the first DAO in array is used
     * @param $modelClass string Model Class that will be used in the controller
     * @param $langArray array Dictionary with words references in the user language
     * @param $viewsFolder string Folder where the templates are stored
     */
    public function __construct(array $daoArray,$isApiCall = false,$modelClass,$viewsFolder,array $langArray)
    {
        $this->isApiCall = $isApiCall;
        $this->daoArray = $daoArray;
        $this->modelClass = $modelClass;
        $this->langArray = $langArray;

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

    public function index()
    {
        $dao = reset($this->daoArray);

        $filter = (!empty($_GET["filter"]) && is_array($_GET["filter"]))?$_GET["filter"]:[];

        $results = $dao->read($filter);

        $this->sendResponse($results,"list");

    }

    public function create()
    {
        $dao = reset($this->daoArray);

        $model = new $this->modelClass ();

        $model = $model->ObjectFromArray($_POST);

        $dao->Create($model);

        $this->sendResponse($model);


    }

    public function update()
    {
        $dao = reset($this->daoArray);

        $model = new $this->modelClass ();

        $model = $model->ObjectFromArray($_POST);


        $dao->Update($model);

        //TODO: set response
        $this->sendResponse([]);
    }

    public function delete(){

        $dao = reset($this->daoArray);

        $id = (!empty($_POST["_id"]))? new \MongoId($_POST["_id"]):false;

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
            $core = new Core();

            $tpl ="{$this->viewsFolder}/{$view}.tpl";


            foreach ($response as $key => $value)
            {
                $response[$key] = $value->printSerialize();
            }

            $data["results"]=[];

            if(!empty($response))
            {
                $data["results"]["values"]  = $response;
                $data["results"]["keys"] = array_keys(reset($response));

            }

            $data["lang"] = $this->langArray;

            echo $core->get($tpl, $data);

        }
    }



}