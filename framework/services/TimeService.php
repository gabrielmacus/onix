<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 13/01/2018
 * Time: 17:02
 */

namespace framework\services;


class TimeService
{

    static function now($format=DATE_ISO8601)
    {

        $now  = new \DateTime();

        return $now->format($format);
    }

}