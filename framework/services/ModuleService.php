<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 19/01/2018
 * Time: 20:48
 */

namespace framework\services;

/**
 * Service that has methods to detect useful info from modules
 * Class ModuleService
 * @package framework\services
 */
class ModuleService
{
    /**
     * Gets the module which an object belongs
     * @param $object object Object that will be used to recognize the module
     * @return string
     */
    static function GetModule( $object)
    {
        $r = new \ReflectionClass(get_class($object));
        $explode = explode("\\",$r->getNamespaceName());


        $module  = $explode[count($explode)- 2];

        return $module;
    }

    /**
     * Gets the model that belongs to the module obtained from an object
     * @param $object object Object that will be used to recognize the module, and, therefore, the model
     * @return string
     */
    static function GetModuleModel($object)
    {

        $r = new \ReflectionClass(get_class($object));

        $explode = explode("\\",$r->getNamespaceName());

        unset($explode[count($explode)-1]);

        $model = implode("\\",$explode);

        return $model."\\model\\".ucfirst(self::GetModule($object));

    }

    /**
     * Gets the model dao
     * @param $object object Object that will be use to recognize the module, and therefore, the model dao
     * @return string
     */
    static function GetModuleModelDAO($object)
    {
        $r = new \ReflectionClass(get_class($object));

        $explode = explode("\\",$r->getNamespaceName());

        unset($explode[count($explode)-1]);

        $dao = implode("\\",$explode);

        return $dao."\\model\\".ucfirst(self::GetModule($object))."DAO";

    }


    /**
     * Gets the views folder where templates are stored
     * @param $object object Object that will be use to recognize the module, and therefore, the views folder
     * @return string
     */
    static function GetModuleView($object)
    {
        $r = new \ReflectionClass(get_class($object));

        $explode = explode("\\",$r->getNamespaceName());

        unset($explode[count($explode)-1]);

        $dao = implode("\\",$explode);

        return $dao."\\view\\" ;

    }
    /**
     * Gets the lang class that belongs to the module obtained from an object
     * @param $object object Object that will be used to recognize the module, and, therefore, the lang
     * @return string
     */
    static function GetModuleLang($object)
    {
        $r = new \ReflectionClass(get_class($object));

        $explode = explode("\\",$r->getNamespaceName());

        unset($explode[count($explode)-1]);

        $dao = implode("\\",$explode);

        return $dao."\\lang\\".ucfirst(self::GetModule($object))."Lang";
    }



}