<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/02/2018
 * Time: 11:39 AM
 */

namespace framework\modules\user\lang;


use framework\modules\base\lang\BaseLang;

class UserLang extends BaseLang
{

    public function loadLang()
    {
        parent::loadLang();

        //Español

        //Errores
        $this->langArray["es"]["invalidUsername"] = "Nombre de usuario no válido. Debe tener de 5 a 20 caracteres, de los cuales son permitidos letras, números y guiones bajo y medio";
        $this->langArray["es"]["invalidEmail"] = "Email no válido";
        $this->langArray["es"]["invalidName"] = "Nombre no válido";
        $this->langArray["es"]["invalidSurname"] = "Apellido no válido";

        return $this->langArray;
    }
}