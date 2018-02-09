<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 09/02/2018
 * Time: 02:53 PM
 */

namespace framework\modules\permission\model;


use framework\modules\base\model\Base;

class Permission extends Base
{


    public function __construct()
    {
        parent::__construct("framework\\modules\\permission\\model\\Permission");
    }

    static function Model()
    {

        $model =parent::Model();

        $model["permission_module"] = ["value"=>"","component"=>"select","attributes"=>["options"=>$modules]];


        return $model;
    }

}