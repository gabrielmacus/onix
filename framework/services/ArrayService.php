<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 08/02/2018
 * Time: 10:30 AM
 */

namespace framework\services;


class ArrayService
{
    static function First($arr)
    {
        return reset($arr);
    }

}