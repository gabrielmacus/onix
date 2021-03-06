<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 05/01/2018
 * Time: 12:12
 */

namespace framework\modules\base\model;


use app\modules\post\model\Post;
use framework\modules\mongoConnection\model\MongoConnection;
use framework\services\ModuleService;
use framework\traits\Magic;

class BaseDAO implements IDAO
{
    use Magic;
   protected $connection;
    /**
     * Model type that is implemented in DAO
     * @var string
     */
   protected $type;

    /**
     * BaseDAO constructor.
     * @param $connection MongoConnection to mongodb database
     */
    public function __construct(MongoConnection $connection = null)
    {
        $this->connection = $connection;

        $this->type = ModuleService::GetModuleModel($this);

    }


    /**
     * Saves a single new element to db
     * @param Base $base
     * @throws \Exception
     */
    function Create(Base &$base)
    {

        $connection = $this->connection;

        $connection->connect();

        $collection = $connection->client()->objects;

        $TypeClass = "{$this->type}";

        $TypeClass::BeforeCreate($base);

        $data = $base->jsonSerialize() + ["_type"=>$base->_type];

        if(! $collection->insert($data))
        {
            throw new \Exception("create",500);
        }


        $TypeClass::AfterCreate($base);

        $base["_id"]  = $data["_id"];

    }

    /**
     * Reads one or many elements from db and maps them as objects
     * @param array $query
     * @return array
     */
    function Read(array $query)
    {


        //Results fetched
        $results = [];

        $connection = $this->connection;

        $connection->connect();

        $collection = $connection->client()->objects;

        $query["_type"] = $this->type;

        $cursor = $collection->find($query);

        foreach ($cursor as $k=>$v)
        {
            $object = new $v["_type"]();

            $results[strval($v["_id"])]= $object->ObjectFromArray($v);
        }



        return $results;
    }

    /**
     * Updates a single element from db
     *
     * @param Base $base Element that will be updated. Should have the _id
     * @throws \Exception
     * @return Base Updated element
     *
     */
    function Update(Base $base)
    {


        $connection = $this->connection;

        $id = (!empty($base["_id"]))?$base["_id"]:false;


        if(!$id)
        {
            throw new \Exception("idIsNotDefined");
        }

        $connection->connect();

        $collection = $connection->client()->objects;

        if(!$itemToUpdate = $collection->find(["_id"=>$id])->getNext())
        {
            throw new \Exception("elementDoesntExist",404);
        }


        $TypeClass = $this->type;

        $TypeClass::BeforeUpdate($base);


        $data =  $base->jsonSerialize();

        unset($data["_id"]);

        $data  = ['$set'=> $data];

        if(!$result = $collection->update(["_id"=>$id],$data ))
        {
            throw new \Exception("update",500);
        }

        //Fetching updated element
        $base =  $this->Read(["_id"=>$id])[strval($id)];

        $TypeClass::AfterUpdate($base);


        return $base;

    }


    /**
     * Deletes a single element from db
     *
     * @param \MongoId $id
     * @throws \Exception
     */
    function Delete($id)
    {

        if(!is_a($id,"MongoId"))
        {
            throw new \MongoException("idNotSpecified",400);
        }

        $connection = $this->connection;

        $connection->connect();

        $collection = $connection->client()->objects;

        if(!$itemToDelete = $collection->find(["_id"=>$id])->getNext())
        {
            throw new \Exception("elementDoesntExist",404);
        }


        $TypeClass = "{$this->type}";
        $TypeClass::BeforeDelete($itemToDelete);

        $collection->remove(["_id"=>$id]);

        $TypeClass::AfterDelete($itemToDelete);

    }

    //TODO: program Replace funcion




}