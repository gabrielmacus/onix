<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 13/01/2018
 * Time: 23:37
 */

namespace framework\modules\base\model;


/**
 * Sets the basic functions to store data into any source
 *
 * Interface IDAO
 * @package framework\modules\base\model
 */
interface IDAO
{

    function Create(Base &$base);
    function Read(array $query);
    function Update(Base $base);
    function Delete( $id);
}