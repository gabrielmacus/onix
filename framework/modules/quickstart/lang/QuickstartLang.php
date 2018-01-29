<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/01/2018
 * Time: 10:37 AM
 */

namespace framework\modules\quickstart\lang;


use framework\modules\base\lang\BaseLang;

class QuickstartLang extends BaseLang
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



        //Errors
        $this->langArray["es"]["initialConfigNotSet"] = "Configuración inicial inexistente";


        return $this->langArray;
    }


}