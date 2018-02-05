<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/01/2018
 * Time: 10:37 AM
 */

namespace framework\modules\quickstart\lang;

use framework\modules\configuration\lang\ConfigurationLang;

class QuickstartLang extends ConfigurationLang
{
    public function loadLang()
    {
        parent::loadLang();

        /**
         * Español
         */
        $this->langArray["es"]["initialConfigData"]="Datos de configuración iniciales";
        $this->langArray["es"]["stepNumber"] ="Paso {0}";
        $this->langArray["es"]["quickstartWelcome"] ="Bienvenido, a continuación deberá seguir una serie de pasos para configurar y poder usar el panel de administración";
        $this->langArray["es"]["superadminData"] ="Datos del usuario Superadministrador";
        $this->langArray["es"]["stepImportantMessage"] = "<b>Importante:</b> no divulgue por ningún medio estos datos, de lo contrario su sitio y/o aplicación quedarán expuestos a atacantes";
        $this->langArray["es"]["applicationData"]="Datos de la aplicación";
        $this->langArray["es"]["siteData"] = "Datos del sitio";
        $this->langArray["es"]["dbData"]="Datos de la BD";
        //Errors
        $this->langArray["es"]["initialConfigNotSet"] = "Configuración inicial inexistente";
        $this->langArray["es"]["step1NotAvailable"] = "Ya completo el paso 1. Por favor, complete el paso 2";
        $this->langArray["es"]["step2NotAvailable"] = "Debe completar el paso 1 primero";



        return $this->langArray;
    }


}