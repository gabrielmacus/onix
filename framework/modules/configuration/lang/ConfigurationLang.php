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

        return $this->langArray;
    }

}