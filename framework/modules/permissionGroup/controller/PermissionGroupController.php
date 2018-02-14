<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 06/02/2018
 * Time: 01:01 PM
 */

namespace framework\modules\permissionGroup\controller;


use framework\modules\base\controller\BaseController;
use framework\modules\permissionGroup\model\Permission;

class PermissionGroupController extends BaseController
{

    function loadPermissionSchema($update = false)
    {
        if(empty($_POST["permission_schema"])):

            return false;
        endif;


       foreach ($_POST["permission_schema"] as $k => $v)
        {
            $permission  = new Permission();

            $permission = $permission->ObjectFromArray($v);

            if($update):

                Permission::BeforeUpdate($permission);

            else:
                Permission::BeforeCreate($permission);
            endif;

            $_POST["permission_schema"][$k] = $permission;

        }
    }
    public function create()
    {
        $this->loadPermissionSchema();
        parent::create();
    }
    public function update()
    {
        $this->loadPermissionSchema(true);
        parent::update();
    }

}