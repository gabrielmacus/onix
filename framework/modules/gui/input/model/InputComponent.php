<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/01/2018
 * Time: 03:37 PM
 */

namespace framework\modules\gui\input\model;


use framework\modules\base\lang\BaseLang;
use framework\modules\gui\form\model\FormElement;

class InputComponent extends FormElement
{

    protected $type;


    public function __construct($label,BaseLang $lang,$type ="text",$extraAttributes=[],$style = false, $js = false, $view = "input")
    {
        $this->label = $label;
        $this->type = $type;
        $this->tabindex = static::$instanceCounter;

        parent::__construct($lang,$extraAttributes, $view, $style, $js);
    }



}