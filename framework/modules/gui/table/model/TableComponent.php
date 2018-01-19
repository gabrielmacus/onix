<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 19/01/2018
 * Time: 11:10 AM
 */

namespace framework\modules\gui\table\model;


use framework\modules\base\lang\BaseLang;
use framework\modules\gui\base\model\BaseComponent;

class TableComponent extends BaseComponent
{

    protected $thead;
    protected $tbody;

    /**
     * TableComponent constructor.
     * @param $thead array Array of table headers
     * @param $tbody array Array of rows that will be in table's body
     * @param $lang BaseLang
     * @param $view
     * @param $style
     * @throws \Exception
     */
    public function __construct(array $thead,array $tbody,BaseLang $lang, $style=false ,$view="table")
    {
        $this->thead = $thead;
        $this->tbody = $tbody;
        $this->templatePath = dirname(__FILE__)."/../view/{$view}.php";

        parent::__construct($view,$style,$lang);

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