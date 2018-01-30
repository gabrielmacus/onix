<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/01/2018
 * Time: 20:29
 */

namespace framework\modules\gui\form\model;


use framework\modules\gui\base\model\BaseComponent;

/**
 * Abstraction of an element that belongs to a form. Eg: an input
 * Class FormElement
 * @package framework\modules\gui\form\model
 */
abstract class FormElement extends BaseComponent
{
    protected $tabindex;
    protected $label;


}