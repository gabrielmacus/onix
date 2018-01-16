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
     * BaseLang constructor.
     * @param $language
     */
    public function __construct($language)
    {
        $this->language = $language;

    }


    public function langArray()
    {

        $langArr=
            [

                "es"=>
                [
                    "noresults"=> "Sin resultados para mostrar"
                ]

            ];


        if(empty($langArr[$this->language]))
        {
            throw new \Exception("languageNotExists",404);
        }

        return $langArr[$this->language];
    }


    public function i18n($data)
    {
        $langArr  =$this->langArray();

        return $langArr[$data];
    }

}