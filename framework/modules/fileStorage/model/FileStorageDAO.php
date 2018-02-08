<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 21/01/2018
 * Time: 12:26
 */

namespace framework\modules\fileStorage\model;


use framework\modules\base\model\Base;
use framework\modules\base\model\IDAO;
use framework\services\FileService;
use framework\services\ModuleService;

/**
 * Manipulates data with basic CRUD functions in json format using a file as storage engine
 * Class FileStorage
 * @package framework\modules\fileStorage\model
 */
class FileStorageDAO  implements IDAO
{

    protected $filePath;

    /**
     * FileStorage constructor.
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;



        if(!file_exists($filePath))
        {
            //Creates file if doesn't exist
            FileService::SaveData($filePath,"{}");
        }

    }




    function Create(Base &$base)
    {


        $base::BeforeCreate($base);
        //TODO: Look for better ways to generate unique ids

        //Checks if id is already defined (for overriding in children)
        $base->_id = (empty($base["_id"]))?md5(uniqid(rand(), true)):$base->_id;

        $data =  FileService::ReadFile($this->filePath,true);

        $data[$base->_id] = $base;


        FileService::SaveData($this->filePath,json_encode($data));

        $base::AfterCreate($base);

        return $base;



    }

    function Read(array $query)
    {

        //TODO: set query algorithm for plain json
        $results = FileService::ReadFile($this->filePath,true);

        $TypeClass = ModuleService::GetModuleModel($this);

        foreach ($results as $k=>$v)
        {
            $obj = new $TypeClass();
            $obj = $obj->ObjectFromArray($v);



            $results[$k] = $obj;

        }

        return $results;
    }

    function Update(Base $base)
    {

        //$base->beforeUpdate();

        $data =  FileService::ReadFile($this->filePath,true);


        if(empty($data[$base->_id]))
        {
            throw new \Exception("elementDoesntExist",404);
        }

        $data[$base->_id] = $base;


        $base::BeforeUpdate($base);

        FileService::SaveData($this->filePath,json_encode($data));


        //Fetching updated element
        $result =  $this->Read(["_id"=>$base->_id])[$base->_id];

        $base::AfterUpdate($base);

        return $result;


    }

    function Delete($id)
    {

        $data =  FileService::ReadFile($this->filePath,true);

        if( is_object($id) || empty($data[$id]) )
        {
            throw new \Exception("elementDoesntExist",404);

        }

        $TypeClass = $data[$id]["_type"];

        $removedItem = new $TypeClass();

        $removedItem = $removedItem->ObjectFromArray($data[$id]);

        $TypeClass::BeforeDelete($removedItem);

        unset($data[$id]);

        FileService::SaveData($this->filePath,json_encode($data));

        $TypeClass::AfterDelete($removedItem);

    }
}