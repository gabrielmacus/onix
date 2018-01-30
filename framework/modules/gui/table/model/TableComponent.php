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
use framework\modules\gui\base\model\ILoopable;

class TableComponent extends BaseComponent implements ILoopable
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
     * @param $js
     * @throws \Exception
     */
    public function __construct(array $thead = [],array $tbody = [],BaseLang $lang,$extraAttributes=[], $style=false ,$js = false,$view="table")
    {
        $this->thead = $thead;
        $this->tbody = $tbody;

        parent::__construct($lang,$extraAttributes,$view,$style,$js);

    }

    function onLoop(array &$item)
    {
        // TODO: Implement onLoop() method.
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