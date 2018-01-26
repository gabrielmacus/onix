<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 26/01/2018
 * Time: 10:15 AM
 */

namespace framework\modules\gui\base\model;


use framework\modules\gui\table\model\TableComponent;

interface ILoopable
{
    /**
     * Is executed every loop before rendering an item from an array that is being rendered
     * @param array $item Current item being rendered
     * @see TableComponent
     *
     */
    function onLoop(array &$item);

}