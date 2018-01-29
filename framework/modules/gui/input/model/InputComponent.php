<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/01/2018
 * Time: 03:37 PM
 */

namespace framework\modules\gui\input\model;


use framework\modules\base\lang\BaseLang;
use framework\modules\gui\base\model\BaseComponent;

class InputComponent extends BaseComponent
{

    protected $type;

    protected $tabindex;
    protected $label;



    public function __construct($label,$type ="text",BaseLang $lang,$style = false, $js = false, $view = "input")
    {
        $this->label = $label;
        $this->type = $type;
        $this->tabindex = static::$instanceCounter;

        parent::__construct($lang, $view, $style, $js);
    }



}