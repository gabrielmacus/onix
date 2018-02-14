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

    static function ExceptionHandler(\Exception $e)
    {

        $code = ($e->getCode()==0)?500:$e->getCode();

        $data =[];
        switch (true)
        {
            case (is_a($e,"\\framework\\modules\\base\\exception\\ValidationException")):

                $data = ["validation"=>true,"errors"=>json_decode($e->getMessage(),true)];
                break;

            case (is_a($e,"\\framework\\modules\\base\\exception\\HandledError")):

                $data  = json_decode($e->getMessage(),true);

                $data["error"]=$data["message"];

                break;

            default:
                $data = ["error"=>$e->getMessage()];
                break;
        }

        echo \framework\services\RouteService::LoadHttpCode($code,$data);

        exit();

    }
}