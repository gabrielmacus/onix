<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 21:49
 */

namespace framework\modules\base\model;

use framework\modules\base\lang\BaseLang;
use framework\services\TimeService;
use framework\services\ValidationService;
use framework\traits\Magic;

class Base implements \ArrayAccess,\JsonSerializable,IPrintable
{
    use Magic;

    protected $updated_at = false;
    protected $created_at;
    protected $_type;



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
     * @var array
     * @return array
     */
    public function rules(){

        return [] ;
    }

    /**
     * Validates model
     * @throws \Exception
     */
    public function validate()
    {
        $result = [];

        foreach ($this->rules() as $rule)
        {
            $prop = (!empty($rule[1]))?$this->$rule[1]:null;


            $params  =[$prop]+$rule[2];

            var_dump($params);

            if(!call_user_func_array("ValidationService::{$rule[0]}",$params))//if(!ValidationService::$rule[0]($prop))    //if(!call_user_func("ValidationService::{$rule[0]}",$prop))
            {

                $result[$this->$rule[1]][] = $rule[3];

            }
        }

        if(count($result) > 0)
        {
            throw new \Exception('validation.'.json_encode($result),400);
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

    function beforeCreate()
    {
        //Sets creation date
        $this->created_at = TimeService::now();

        $this->validate();


    }
    function afterCreate()
    {
        //TODO: Implement
    }

    function beforeUpdate()
    {
        //Sets modification date

        $this->updated_at = TimeService::now();

        $this->validate();
    }
    function afterUpdate()
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

        foreach ($base as $k=>$v)
        {
            unset($base[$k]);
        }


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
           if($k!="_id" && $k!="_type" && $k!="password")
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
}