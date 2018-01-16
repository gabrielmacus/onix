<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 04/01/2018
 * Time: 21:49
 */

namespace framework\modules\base\model;

use framework\services\TimeService;
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
    }
    function afterCreate()
    {
        //TODO: Implement
    }

    function beforeUpdate()
    {
        //Sets modification date

        $this->updated_at = TimeService::now();
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

    public function printSerialize()
    {
       $printableData = [];

       foreach ($this as $k=>$v)
       {
           if($k!="_id" && $k!="_type" && $k!="password")
           {
               $printableData[$k]=$v;
           }

       }

       return $printableData;
    }
}