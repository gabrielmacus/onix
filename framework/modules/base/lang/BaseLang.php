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

        //TODO: complete missing keys (mostly errors) and find a way to load array from file (maybe passing file path to __construct)
        /**
         * Español
         */
        $this->langArray["es"]["noresults"] = "Sin resultados para mostrar";
        $this->langArray["es"]["updated_at"] = "Fecha de modificicación";
        $this->langArray["es"]["created_at"] = "Fecha de creación";
        $this->langArray["es"]["templateNotExists"] = "El template seleccionado no existe";

        /**
         *
         */


        if(empty($this->langArray[$this->language]))
        {
            throw new \Exception("languageNotExists",404);
        }


        return $this->langArray[$this->language];
    }


    public function i18n($data)
    {
        $langArr  =$this->langArray();

        if(!empty($langArr[$data]))
        {
            return $langArr[$data];
        }

        return $data;

    }

}