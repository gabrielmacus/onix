<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/01/2018
 * Time: 03:09 PM
 */

namespace framework\modules\gui\form\model;


use framework\modules\base\lang\BaseLang;
use framework\modules\gui\base\model\BaseComponent;

class FormComponent extends BaseComponent
{
    protected $formElementsArr;
    protected $action;
    protected $method;
    protected $enctype;
    public function __construct(array $formElementsArr,$action,BaseLang $lang,$extraAttributes = [],$enctype="application/x-www-form-urlencoded",$method="post", $view ="form", $style = false, $js = false)
    {
        $this->action = $action;
        $this->method =$method;
        $this->enctype =$enctype;
        $this->formElementsArr = $formElementsArr;

        parent::__construct($lang,$extraAttributes, $view, $style, $js);
    }


}