<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 06/01/2018
 * Time: 23:51
 */

namespace framework\modules\base\model;


interface IPrintable
{

    /**
     * Returns an array of data from the model to be printed on screen, formatted like [property name] = value
     * Example: array( 'Name'=>'John', 'Surname'=>'Doe', 'Date of birth' => '1996-06-06' )
     * @return array
     */
    public function printSerialize();

}