<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 20/01/2018
 * Time: 22:35
 */

namespace framework\services;


class StringService
{

    /**
     * Replaces string key ocurrences from given an array
     * Example: String = "The{0} chases the {1}". Given array = ["dog","cat"]. Result: "The dog chases the cat"
     * @param $string
     * @param $array
     * @return string
     */
    static function Replace($string,array $array)
    {
        foreach ($array as $k=>$v)
        {
            $string = str_replace("{{$k}}",$v,$string);
        }

        return $string;

    }
}