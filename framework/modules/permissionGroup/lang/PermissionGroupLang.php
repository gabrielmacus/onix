<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 07/02/2018
 * Time: 04:09 PM
 */

namespace framework\modules\permissionGroup\lang;


use framework\modules\base\lang\BaseLang;

class PermissionGroupLang extends BaseLang
{

    public function loadLang()
    {
        parent::loadLang();

        /**
         * Español
         */
        $this->langArray["es"]["permissionOwner"] = "Propietario";
        $this->langArray["es"]["permissionGroup"] = "Grupo";
        $this->langArray["es"]["permissionAll"] = "Todos";
        $this->langArray["es"]["create"] = "Crear";
        $this->langArray["es"]["read"] = "Leer";
        $this->langArray["es"]["update"] = "Modificar";
        $this->langArray["es"]["delete"] = "Eliminar";
        $this->langArray["es"]["permission_group_name"] = "Nombre del grupo de permisos";
        $this->langArray["es"]["permission_schema"] = "Esquema de permisos";
        $this->langArray["es"]["addPermission"] = "Agregar permiso";


        //Erroes
        $this->langArray["es"]["invalidPermissionLevel"] = "Nivel de permiso inválido";
        $this->langArray["es"]["invalidPermissionAction"] = "Acción de permiso inválida";

        return $this->langArray;
    }

}