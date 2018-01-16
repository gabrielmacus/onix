<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 05/01/2018
 * Time: 12:12
 */

namespace framework\modules\base\model;


use framework\modules\mongoConnection\model\MongoConnection;
use framework\traits\Magic;

class BaseDAO implements IDAO
{
    use Magic;
   protected $connection;

    /**
     * BaseDAO constructor.
     * @param $connection
     */
    public function __construct(MongoConnection $connection = null)
    {
        $this->connection = $connection;
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

        $base->beforeCreate();

        $data = $base->jsonSerialize() + ["_type"=>$base->_type];

        if(! $collection->insert($data))
        {
            throw new \Exception("create",500);
        }

        $base->afterCreate();


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
     *
     */
    function Update(Base $base)
    {
        $connection = $this->connection;

        $id = (!empty($base->_id))?$base->_id:false;

        if(!$id)
        {
            throw new \Exception("idIsNotDefined");
        }

        $connection->connect();

        $collection = $connection->client()->objects;

        if(!$itemToUpdate = $collection->find(["_id"=>$id])->getNext())
        {
            throw new \Exception("elementDoesntExist");
        }

        $base->beforeUpdate();

        $data =  $base->jsonSerialize();

        unset($data["_id"]);

        $data  = ['$set'=> $data];

        if(!$collection->update(["_id"=>$id],$data ))
        {
            throw new \Exception("update",500);
        }

        $base->afterUpdate();

    }

    /**
     * Deletes a single element from db
     *
     * @param \MongoId $id
     * @throws \Exception
     */
    function Delete(\MongoId $id)
    {

        $connection = $this->connection;

        $connection->connect();

        $collection = $connection->client()->objects;

        if($collection->count(["_id"=>$id]) == 0)
        {
            throw new \Exception("elementDoesntExist");
        }

        $collection->remove(["_id"=>$id]);
    }

    //TODO: program Replace funcion




}