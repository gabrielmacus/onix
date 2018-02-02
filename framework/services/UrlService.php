<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 20/01/2018
 * Time: 13:01
 */

namespace framework\services;


class UrlService
{
    static function UrlSlug($string) {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }

    static function GetSubdomain()
    {
       return explode('.', $_SERVER["HTTP_HOST"])[0];

    }
    static function CurrentUrl($requestUri = false)
    {
        $url =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        return (!$requestUri)?$url:$url.$_SERVER["REQUEST_URI"];
    }
}