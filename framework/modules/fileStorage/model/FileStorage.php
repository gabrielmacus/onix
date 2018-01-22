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

/**
 * Manipulates data with basic CRUD functions in json format using a file as storage engine
 * Class FileStorage
 * @package framework\modules\fileStorage\model
 */
class FileStorage extends Base implements IDAO
{

    //TODO: Call beforeDelete() and  afterDelete() (only if required)

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


        $base->_id = uniqid("",true);

        $this->Update($base);



    }

    function Read(array $query)
    {
        //TODO: set query algorithm for plain json
        return FileService::ReadFile($this->filePath,true);
    }

    function Update(Base $base)
    {

        //$base->beforeUpdate();

        $data =  FileService::ReadFile($this->filePath,true);

        $data[$base->_id] = $base;

        FileService::SaveData($this->filePath,json_encode($data));



    }

    function Delete($id)
    {


        $data =  FileService::ReadFile($this->filePath,true);

        unset($data[$id]);


        FileService::SaveData($this->filePath,json_encode($data));

    }
}