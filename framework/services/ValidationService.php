<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 19/01/2018
 * Time: 11:58 AM
 */

namespace framework\services;


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

    //TODO: make validation methods that evaluates if exists and meets the condition, and if doesn't, return true. For example: IsUrl, its counterpart will be, IsUrlIfExist

}