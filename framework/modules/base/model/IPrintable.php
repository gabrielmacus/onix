<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 06/01/2018
 * Time: 23:51
 */

namespace framework\modules\base\model;


use framework\modules\base\lang\BaseLang;

interface IPrintable
{

    /**
     * Returns an array of data from the model to be printed on screen, formatted like [property name] = value
     * Example: array( 'Name'=>'John', 'Surname'=>'Doe', 'Date of birth' => '1996-06-06' )
     * @param $lang BaseLang Language object that will be used in function, for example, to get date format according to user language
     * @return array
     */
    public function printSerialize(BaseLang $lang);



}