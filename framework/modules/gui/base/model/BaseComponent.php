<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 19/01/2018
 * Time: 11:04 AM
 */

namespace framework\modules\gui\base\model;


use framework\modules\base\lang\BaseLang;
use framework\traits\Magic;

/**
 * Foundation for custom Components that results in html
 * Class BaseComponent
 * @package framework\modules\gui\base\model
 */
abstract class BaseComponent
{
    use Magic;
    protected $view;
    protected $style;
    protected $templatePath;
    protected $lang;

    /**
     * BaseComponent constructor. Should be called AFTER children's __construct call
     * @param $view  string Template that will be used from the view folder in component's root. This param gives you the posibility to select between multiple templates in one component
     * @param $style mixed Path where css file to be applied to the component is stored
     * @param $lang BaseLang Language object that will be used
     * @throws \Exception
     */
    public function __construct($view,$style = false,BaseLang $lang)
    {


        if(!file_exists($this->templatePath))
        {
            throw new \Exception("templateNotExists",404);
        }


        $this->lang =$lang;
        $this->view = $view;
        $this->style = $style;
    }


    /**
     * Method that process data in order to output a html string
     * @return string
     */
     function getHtml()
     {
         ob_start();
         if($this->style && file_exists($this->style))
         {
             echo "<link rel='stylesheet' href='{$this->style}'>";

         }
         $html = ob_get_contents();
         ob_end_clean();

         return $html;
     }

    function __toString()
    {
       return $this->getHtml();
    }

}