<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 06/02/2018
 * Time: 01:01 PM
 */

namespace framework\modules\permissionGroup\model;

use framework\modules\base\model\Base;

class PermissionGroup extends Base
{

    static function Model()
    {
        $model = parent::Model();

        $model["permission_group_name"]=["value"=>""];

        /**
         * @var array $model["permission_schema"] Array of Permission
         */
        $model["permission_schema"]=["value"=>[],'component'=>'permission-schema'];


        return $model;
    }
    public function validate()
    {
       $rules =  parent::validate();; // TODO: Define validation rules

        return $rules;

    }

}