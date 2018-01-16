<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 11/01/2018
 * Time: 19:35
 */
namespace framework\modules\base\lang;

use framework\traits\Magic;

class BaseLang
{
    use  Magic;
    protected $language;
    /**
     * Multilingual words array
     * @var
     */
    protected $langArray = [];

    /**
     * BaseLang constructor.
     * @param $language
     */
    public function __construct($language)
    {
        $this->language = $language;

    }


    /**
     * Gets the words array, corresponding to selected language
     *
     * @return array
     * @throws \Exception
     */
    public function langArray()
    {

        /**
         * Español
         */
        $this->langArray["es"]["noresults"] = "Sin resultados para mostrar";
        $this->langArray["es"]["noresults"] = "Fecha de modificicación";
        $this->langArray["es"]["noresults"] = "Fecha de creación";


        if(empty($this->langArray[$this->language]))
        {
            throw new \Exception("languageNotExists",404);
        }


        return $this->langArray[$this->language];
    }


    public function i18n($data)
    {
        $langArr  =$this->langArray();

        return $langArr[$data];
    }

}