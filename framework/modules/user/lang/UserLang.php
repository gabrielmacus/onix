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
        $this->langArray["es"]["registerConfirmationSubject"] = "Confirmación de registro - {0}";
        $this->langArray["es"]["registerConfirmationTitle"]  ="Solo le queda un paso para ser parte de {0}";
        $this->langArray["es"]["confirmationLinkText"] = "Link de confirmación";
        $this->langArray["es"]["userConfirmed"] = "El usuario {0}, ha sido confirmado exitosamente";
        $this->langArray["es"]["userConfirmedTitle"] = "Confirmación de usuario";
        $this->langArray["es"]["password"] = "Contraseña";
        $this->langArray["es"]["confirmationText"]="Será redirigido al inicio en <span id='timeout'>5</span>";

        //Errores
        $this->langArray["es"]["invalidUsername"] = "Nombre de usuario no válido. Debe tener de 5 a 20 caracteres, de los cuales son permitidos letras, números y guiones bajo y medio";
        $this->langArray["es"]["invalidEmail"] = "Email no válido";
        $this->langArray["es"]["invalidName"] = "Nombre no válido";
        $this->langArray["es"]["invalidSurname"] = "Apellido no válido";
        $this->langArray["es"]["shouldBeSuperadmin"] = "El usuario debe ser superadministrador, ya que no existen otros permisos disponibles";
        $this->langArray["es"]["errorSendingValidationEmail"]="Error al enviar el email de validación. Inténtelo con otra cuenta de email";
        $this->langArray["es"]["userNotExistsOrConfirmed"] = "El usuario no existe o ya ha sido confirmado";
        $this->langArray["es"]["missingConfirmationCode"] = "Se requiere un código de confirmación";
        $this->langArray["es"]["invalidPassword"] = "La contraseña puede contener letras, números, y los siguientes caractéres: <b>-_#@?¿</b>";

        return $this->langArray;
    }
}