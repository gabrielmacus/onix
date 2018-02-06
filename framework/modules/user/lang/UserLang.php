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

        $this->langArray["es"]["username"]="Nombre de usuario";
        $this->langArray["es"]["name"] = "Nombre de pila";
        $this->langArray["es"]["surname"] = "Apellido";
        $this->langArray["es"]["email"] = "Email del usuario";
        $this->langArray["es"]["permission"] = "Permisos del usuario";
        $this->langArray["es"]["superadmin"] ="Superadministrador";
        $this->langArray["es"]["emptyPermissionsSelect"]="No hay permisos para seleccionar";

        //Errores
        $this->langArray["es"]["invalidUsername"] = "Nombre de usuario no válido. Debe tener de 5 a 20 caracteres, de los cuales son permitidos letras, números y guiones bajo y medio";
        $this->langArray["es"]["invalidEmail"] = "Email no válido";
        $this->langArray["es"]["invalidName"] = "Nombre no válido";
        $this->langArray["es"]["invalidSurname"] = "Apellido no válido";
        $this->langArray["es"]["shouldBeSuperadmin"] = "El usuario debe ser superadministrador, ya que no existen otros permisos disponibles";
        $this->langArray["es"]["errorSendingValidationEmail"]="Error al enviar el email de validación. Inténtelo con otra cuenta de email";

        return $this->langArray;
    }
}