<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 24/01/2018
 * Time: 02:40 PM
 */

namespace framework\modules\configuration\model;



use framework\modules\base\model\Base;
use framework\modules\fileStorage\model\FileStorage;

class Configuration extends FileStorage
{
    function model()
    {
        $model = parent::model();

        $model["_id"]="";
        //TESTING,DEVELOPMENT or PRODUCTION
        $model["env"] ="DEVELOPMENT";

        $model["active"] = false;

        //App parameters
        $model["app_name"]="";
        $model["app_url"]="";
        //TODO: set an id for every app that is deployed
        $model["app_id"] ="";

        //Site parameters
        $model["site_name"]="";
        $model["site_url"]="";


        //DB config
        $model["db_name"]="";
        $model["db_user"]="";
        $model["db_pass"]="";
        $model["db_port"]="";
        $model["db_host"]="";



        return $model;
    }



    public function rules()
    {
        return parent::rules(); // TODO: Set Config validation rules
    }

    static function BeforeUpdate(Base &$obj)
    {
        parent::BeforeUpdate($obj); // TODO: Change the autogenerated stub
    }



}