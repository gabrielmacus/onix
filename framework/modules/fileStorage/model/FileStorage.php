<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 25/01/2018
 * Time: 11:12 AM
 */

namespace framework\modules\fileStorage\model;


use framework\modules\base\model\Base;

class FileStorage extends Base
{

    public function ObjectFromArray(Array $array)
    {

        $array["_type"]=$this->_type;
        $Class = get_class($this);
        $base = new $Class();

        /*
        foreach ($base as $k=>$v)
        {
            unset($base[$k]);
        }*/


        foreach ($array as $k=>$v)
        {
            $base[$k]=$v;
        }

        return $base;
    }

}