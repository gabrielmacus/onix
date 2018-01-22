<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 20/01/2018
 * Time: 15:26
 */

namespace framework\modules\gui\navbar\model;


use framework\modules\base\lang\BaseLang;
use framework\modules\gui\base\model\BaseComponent;

class NavbarComponent extends BaseComponent
{
    public function __construct(BaseLang $lang, $style = false, $js = false ,$view = "navbar")
    {

        parent::__construct($lang, $view, $style, $js);
    }


    function getHtml()
    {
        ob_start();
        echo parent::getHtml();
        include $this->templatePath;
        $html = ob_get_contents();
        ob_end_clean();


        return $html;
    }


}