<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 24/01/2018
 * Time: 02:40 PM
 */

namespace framework\modules\config\model;

use framework\modules\base\model\Base;

class Config extends Base
{
    function model()
    {
        $model = parent::model();

        $model["_id"]="";
        //TESTING,DEVELOPMENT or PRODUCTION
        $model["env"] ="DEVELOPMENT";

        //App parameters
        $model["app_name"]="";
        $model["app_url"]="";

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

}