<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 09/02/2018
 * Time: 02:53 PM
 */

namespace framework\modules\permissionGroup\model;

define("PERMISSION_OWNER",1);
define("PERMISSION_GROUP",2);
define("PERMISSION_ALL",3);


use framework\modules\base\model\Base;
use framework\services\ModuleService;

class Permission extends Base
{


    public function __construct()
    {
        parent::__construct("framework\\modules\\permissionGroup\\model\\Permission");
    }

    static function Model()
    {
        $modules = ModuleService::GetRestrictedModules();

        $model =parent::Model();

        $model["permission_module"] = ["value"=>"","component"=>"select","attributes"=>["options"=>array_combine($modules,$modules)]];

        $permissionLevels = [PERMISSION_OWNER=>'permissionOwner',PERMISSION_GROUP=>'permissionGroup',PERMISSION_ALL=>'permissionAll'];

        $model["permission_level"] = ["value"=>'','component'=>'select','attributes'=>['options'=>$permissionLevels]];

        $model['permission_action'] = ['value'=>'','component'=>'select','attributes'=>['options'=>[]]];


        return $model;
    }

    public function rules()
    {
        $rules = [];


        $rules[] = ['InRange','permission_level',[PERMISSION_OWNER,PERMISSION_ALL],'invalidPermissionLevel'];
        //$rules[] = ['InRange','permission_action',[PERMISSION_CREATE,PERMISSION_DELETE],'invalidPermissionAction'];




        return $rules;
    }


}