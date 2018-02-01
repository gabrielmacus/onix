<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 21:49
 */

namespace framework\modules\base\model;

use framework\modules\base\exception\ValidationException;
use framework\modules\base\lang\BaseLang;
use framework\services\LanguageService;
use framework\services\ModuleService;
use framework\services\TimeService;
use framework\services\ValidationService;
use framework\traits\Magic;

class Base implements \ArrayAccess,\JsonSerializable,IPrintable
{
    use Magic;

    /*
    protected $updated_at = false;
    protected $created_at;
    protected $_type;
    protected $_id;*/


    /**
     * Defines properties of the model.
     * Format is:
     * $model  = ['property_name'=>'default_value']
     * @return array
     */
    function model()
    {
        $model =
            [
                "updated_at" => "",
                "created_at" =>TimeService::now(),
                "_type" => ""
            ];
       return  $model;
    }

    /**
     * Cleans properties that aren't defined on Model() from an object
     * @see model()
     * @param Base $obj Object to be cleaned
     */
    static function CleanModel(Base &$obj)
    {


        foreach ($obj as $k=>$v)
        {

            if(!isset($obj->model()[$k]))
            {
                unset($obj[$k]);
            }
        }

    }

    /**
     * Sets default property values, according to Model(), to an object
     * @see model()
     * @param Base $obj Object that will be set
     */
    static function SetDefaultProperties(Base &$obj)
    {
        //Sets default data
        foreach ($obj->model() as $property => $default)
        {
            if(!isset($obj[$property]))
            {
                $obj[$property] = $default;
            }
        }
    }




    /**
     * Base constructor.
     * @param mixed $_type The type of the object that will be stored, it's the current classname by default
     * @throws \Exception
     */
    public function __construct($_type=false)
    {

        $this->_type = (!empty($_type))?$_type:get_class($this);

        if(!class_exists($this->_type))
        {
            throw new \Exception("classNotExists:{$this->_type}",500);
        }


    }

    /**
     * Validation rules.
     * Format: $rules = [
     * ['validationFunction','propName',[extraParams] ,'messageForLangClass']
     *]
     * The message for lang class is the key that will be associated to a phrase in current module's lang class
     * The validation function is an static function taken from ValidationService
     * @see ValidationService
     * @var array
     * @return array
     */
    public function rules(){

        $rules = [];

        return $rules;
    }

    /**
     * Validates model
     * If i'm updating, only set properties are validated, and, if i'm creating, the whole model is validated
     * @throws ValidationException
     */
    public function validate()
    {


        $result = [];

        $LangClass = ModuleService::GetModuleLang($this);

        $lang  = new $LangClass(LanguageService::detectLanguage());


        foreach ($this->rules() as $rule)
        {

            $prop = (!empty($this[$rule[1]]))?$this->$rule[1]:null;


                if((!isset($prop) xor isset($this->_id)) || isset($prop))
                {

                     //If a property is empty or the model is updating, but not both, or in case the property is set

                    $params = array_merge([$prop],$rule[2]);


                    if(!call_user_func_array("framework\\services\\ValidationService::{$rule[0]}",$params))//if(!ValidationService::$rule[0]($prop))    //if(!call_user_func("ValidationService::{$rule[0]}",$prop))
                    {

                        $result[$rule[1]][] = ["text"=>$lang->i18n($rule[3])];

                    }
                }



        }

        if(count($result) > 0)
        {

            throw new ValidationException(json_encode($result));
        }

    }




    static function BeforeCreate(Base &$obj)
    {

        static::CleanModel($obj);

        static::SetDefaultProperties($obj);

        $obj->validate();


    }
    static function AfterCreate(Base &$obj)
    {
        //TODO: Implement
    }
    static function BeforeUpdate(Base &$obj)
    {
        //Sets modification date
        $obj->updated_at = TimeService::now();

        $obj->validate();

        static::CleanModel($obj);



    }
    static function AfterUpdate(Base &$obj)
    {
        //TODO: Implement
    }
    static function BeforeDelete(Base &$obj)
    {
        //TODO: Implement
    }
    static function AfterDelete(Base &$obj)
    {
        //TODO: Implement
    }







    /**
     * Maps array into object
     *
     *
     * @param array $array
     * @return mixed
     */
    public function ObjectFromArray(Array $array)
    {

        $array["_type"]=$this->_type;
        $Class = get_class($this);
        $base = new $Class();

        /*
        foreach ($base as $k=>$v)
        {
            unset($base[$k]);
        }*/


        foreach ($array as $k=>$v)
        {
            if($k == "_id")
            {
                $v = new \MongoId($v);
            }

            $base[$k]=$v;
        }

        return $base;
    }

    public function printSerialize(BaseLang $lang)
    {
       $printableData = [];

       foreach ($this as $k=>$v)
       {
           if(  $k!="_type" && $k!="password")
           {
               if(($k== "updated_at" || $k=="created_at") && !empty($lang->langArray()['dateFormat']))
               {
                   $date = new \DateTime($v);

                   $v  = $date->format($lang->i18n("dateFormat"));
               }


                   $printableData[$k]=$v;
           }


       }

       return $printableData;
    }

    static function PrintSerializeArray(array &$arr,BaseLang $lang)
    {


       foreach ($arr as $k=>$v)
       {
           if($v instanceof IPrintable)
           {
               $arr[$k] = $v->printSerialize($lang);
           }
       }
    }


    public function offsetExists($offset)
    {

        return isset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {

        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    function jsonSerialize()
    {
        $json = [];
        foreach ($this as  $k=>$v)
        {
            if(isset($this[$k]))
            {
                if($k=="_id")
                {
                    $v = strval($v);
                }

                $json[$k]=$v;
            }
        }

        return $json;
    }

}