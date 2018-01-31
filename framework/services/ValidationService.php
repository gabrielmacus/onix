<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 19/01/2018
 * Time: 11:58 AM
 */

namespace framework\services;

/**
 * Service that has validation functions
 *
 * Class ValidationService
 * @package framework\services
 */
class ValidationService
{
    /**
     * Validates if the parameter is an url with valid format
     * @param string $url String to validate
     * @param boolean $emptyIsValid Sets if, in case of string being empty, is valid or not
     * @return mixed
     */
    static function IsUrl($url,$emptyIsValid = false)
    {

        $isValid = ($emptyIsValid && empty($url))?true:filter_var($url, FILTER_VALIDATE_URL);

        return $isValid;
    }

    /**
     * Determines if a number is between a range
     *
     * @param $number int Number to evaluate
     * @param $max int Max value
     * @param $min int Min value
     * @param bool $inclusive Sets if equality of the $number to $max or $min should be considered in range
     * @return bool
     */
    static function InRange($number,$max,$min,$inclusive = true)
    {

        if(!is_numeric($number)){

            return false;
        }

        if($inclusive)
        {

            if($max > $number || $min < $number)
            {
                return false;
            }

        }
        else
        {
            if($max >= $number || $min <= $number)
            {
                return false;
            }
        }
        return true;
    }


    /**
     * Validates if a given string matches length
     * @param $string String to be matched
     * @param boolean|integer $min Min string length. If false, only max is used to match
     * @param boolean|integer $max Max string length. If false, only min is used to match
     * @param bool $emptyIsValid
     * @throws \Exception
     * @return boolean
     */
    static function MatchesLength($string,$min=false,$max=false,$emptyIsValid=false)
    {

        $string  =trim($string);

        if(!$min && !$max)
        {
            throw new \Exception('$max or $min parameter should be specified',400);
        }

        if(!empty($string))
        {
            //If string isn't or
            if($min && strlen($string) < $min)
            {
                //If string is lesser than the min allowed size
                return false;
            }

            if($max && strlen($string) > $max)
            {
                //If string is greater than the max allowed size
                return false;
            }
        }
        elseif(empty($string)  && !$emptyIsValid )
        {
            return false;
        }



        return true;

    }

    /**
     * Checks if string isn't empty
     * @param $string
     * @return bool
     */
    static function NotEmpty($string)
    {
        return !empty($string);
    }

}