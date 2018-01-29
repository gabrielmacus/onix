<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 11/01/2018
 * Time: 19:35
 */
namespace framework\modules\base\lang;

use framework\services\StringService;
use framework\traits\Magic;

/**
 * Class to process text in multiple languages
 *
 * Class BaseLang
 * @package framework\modules\base\lang
 */
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

        $this->loadLang();

    }

    /**
     * In this function, you define the array with words, to add more phrases you should override and implement this on children class
     * @return array
     */
    public function loadLang()
    {
        //TODO: complete missing keys (mostly errors) and find a way to load array from file (maybe using ModuleService functions to detect where the file is stored in module)
        /**
         * Español
         */
        $this->langArray["es"]["noresults"] = "Sin resultados para mostrar";
        $this->langArray["es"]["updated_at"] = "Fecha de modificación";
        $this->langArray["es"]["created_at"] = "Fecha de creación";
        $this->langArray["es"]["dateFormat"] = "d-m-Y H:i";
        $this->langArray["es"]["_id"] = "ID";

        //Errores
        $this->langArray["es"]["invalidUrl"] = "Formato de url no válido";
        $this->langArray["es"]["lengthBetween"] = "Debe tener ente {0} y {1} caracteres";
        $this->langArray["es"]["cantBeEmpty"] = "No puede estar vacío";
        $this->langArray["es"]["idNotSpecified"] = "No se especifico un id correcto";
        $this->langArray["es"]["fileNotFound"] = "Archivo no encontrado";
        $this->langArray["es"]["elementDoesntExist"] = "El elemento requerido no existe";
        $this->langArray["es"]["templateNotExists"] = "El template seleccionado no existe";


        /**
         *
         */

        return $this->langArray;
    }

    /**
     * Gets the words array, corresponding to selected language.
     *
     *
     * @return array
     * @throws \Exception
     */
    public function langArray()
    {

        if(empty($this->langArray[$this->language]))
        {
            throw new \Exception("languageNotExists",404);
        }


        return $this->langArray[$this->language];
    }


    /**
     * @param $data string Key that matches the required phrase in dictionary
     *
     * If you wanna pass arguments to the required string, the format is this: keyString:parameters,separated,by,comma
     * And the required string should have position slots to replace.
     * @see StringService::Replace()
     * @return string
     *
     *
     */
    public function i18n($data)
    {
        $langArr  =$this->langArray();

        if(!strpos($data,":"))
        {
            //Simple key
            if(!empty($langArr[$data]))
            {
                return $langArr[$data];
            }

        }
        else
        {
            //Key with arguments to replace in the string

            $dataArr = explode(":",$data);

            if(!empty($langArr[$dataArr[0]]))
            {
                return StringService::Replace($langArr[$dataArr[0]],explode(",",$dataArr[1]));
            }

        }

        return $data;

    }

}