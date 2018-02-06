<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 06/02/2018
 * Time: 11:40 AM
 */

namespace framework\services;


class DebugService
{

    static function _print($var)
    {
        echo "<pre>";

            print_r($var);

        echo "</pre>";
    }
}