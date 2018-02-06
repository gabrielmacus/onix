<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 24/01/2018
 * Time: 02:57 PM
 */

namespace framework\modules\configuration\lang;


use framework\modules\base\lang\BaseLang;

class ConfigurationLang extends BaseLang
{

    public function loadLang()
    {
        parent::loadLang();

        //Español
        $this->langArray["es"]["_type"] = "Tipo";

        $this->langArray["es"]["env"] = "Entorno";
        $this->langArray["es"]["app_name"] = "Nombre de la aplicación";
        $this->langArray["es"]["app_url"] = "URL de la aplicación";
        $this->langArray["es"]["site_name"] = "Nombre del sitio";
        $this->langArray["es"]["site_url"] = "URL del sitio";
        $this->langArray["es"]["noresults"] = "No hay ninguna configuración cargada";
        $this->langArray["es"]["db_name"] = "Nombre de la base de datos";
        $this->langArray["es"]["db_user"] = "Usuario de la base de datos";
        $this->langArray["es"]["db_pass"] = "Contraseña de la base de datos";
        $this->langArray["es"]["db_host"] = "Host de la base de datos";
        $this->langArray["es"]["db_port"] = "Puerto de la base de datos";
        $this->langArray["es"]["email_host"] = "Host de email";
        $this->langArray["es"]["email_smtp_auth"] = "¿Activar autenticación SMTP?";
        $this->langArray["es"]["email_smtp_secure"]="Tipo de autenticación SMTP";
        $this->langArray["es"]["email_username"] = "Usuario de email";
        $this->langArray["es"]["email_password"] = "Contraseña de email";
        $this->langArray["es"]["email_port"] = "Puerto de email";
        $this->langArray["es"]["email_address"] = "Cuenta de email";
        $this->langArray["es"]["emailTestMessage"] = "Este email solo tiene como propósito testear que la cuenta ingresada en la configuración de {0} funcione correctamente";
        $this->langArray["es"]["testEmail"] = "Email de prueba - {0}";
        $this->langArray["es"]["emailNotWorking"] = "La cuenta de email seleccionada no esta funcionando, seleccione una alternativa";
        //Errors
        $this->langArray["es"]["portRangeAllowed"] = "El rango de puertos permitido es de {0} a {1}";
        $this->langArray["es"]["appNameNotAllowed"] = "El nombre de la aplicación puede contener letras, números, espacios y  '_','.' o '-', siendo de un largo entre 5 y 30 caracteres";
        $this->langArray["es"]["mainEmailNotValid"] = "Email principal inválido";
        $this->langArray["es"]["siteNameNotAllowed"] = "El nombre del sitio puede contener letras, números, espacios y  '_','.' o '-', siendo de un largo de 5 a 40 caracteres";
        $this->langArray["es"]["invalidEmailHost"]="Host de email inválido";


        return $this->langArray;
    }

}