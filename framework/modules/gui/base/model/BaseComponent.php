<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 19/01/2018
 * Time: 11:04 AM
 */

namespace framework\modules\gui\base\model;


use framework\modules\base\lang\BaseLang;
use framework\services\ModuleService;
use framework\services\ValidationService;
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
    protected $js;
    protected $templatePath;
    protected $lang;

    /**
     * BaseComponent constructor. Should be called AFTER children's __construct call
     * @param $view  string Template that will be used from the view folder in component's root. This param gives you the posibility to select between multiple templates in one component
     * @param $style mixed String/array with Path/Url where css file/s to be applied to the component is/are stored
     * @param $lang BaseLang Language object that will be used
     * @param $js mixed String/array with Path/Url where js file/s to be applied to the component is/are stored
     * @throws \Exception
     */
    public function __construct(BaseLang $lang,$view,$style = false, $js=false)
    {

        if(empty($this->templatePath))
        {

            $this->templatePath = ROOT_DIR.ModuleService::GetModuleView($this)."/{$view}.php";
        }


        if(!file_exists($this->templatePath))
        {
            throw new \Exception("templateNotExists",404);
        }

        $this->lang =$lang;
        $this->view = $view;


        if(empty($style))
        {
            $this->style = [];
        }
        else
        {
            $this->style = (!is_array($style))?[$style]:$style;

        }

        if(empty($js))
        {
            $this->js = [];
        }
        else
        {
            $this->js = (!is_array($js))?[$js]:$js;
        }

    }


    /**
     * Method that process data in order to output a html string
     * @return string
     */
     function getHtml()
     {

         ob_start();

         //Loads CSS

         foreach ($this->style as $style)
         {
             if(ValidationService::IsUrl($style))
             {
                 echo "<link rel='stylesheet' href='{$style}'>";
             }
             else if($style && file_exists($style))
             {
                 echo "<style>".file_get_contents($style)."</style>";
             }
         }



         //Loads JS
         foreach ($this->js as $js)
         {
             if(ValidationService::IsUrl($js))
             {
                 echo "<script src='{$js}'></script>";
             }
             else if(file_exists($js))
             {
                 echo "<script type='application/javascript'>".file_get_contents($js)."</script>";
             }

         }




         $html = ob_get_contents();
         ob_end_clean();

         return $html;
     }

    function __toString()
    {
        ob_start();

        $r  = new \ReflectionClass(get_class($this));

        echo "<!--- ".$r->getShortName()." --->";

        echo $this->getHtml();

        echo "<!--- END ".$r->getShortName()." --->";

        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

}