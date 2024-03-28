<?php

namespace src\db;

use MongoDB\Client as MongoDB;
use MongoDB\Collection;
use MongoDB\Database;

class MongoDBClient
{
    /**
     * @var MongoDB
     */
    protected MongoDB $client;
    /**
     * @var Database
     */
    protected Database $db;
    /**
     * @var Collection
     */
    protected Collection $collection;

    /**
     *
     */
    public function __construct()
    {
        global $config;
        // Connect to the MongoDB
        $this->client = new MongoDB(
            'mongodb://' . $config['mongo_user'] . ':' . $config['mongo_password'] . '@' . $config['mongo_host'] . ':' . $config['mongo_port']
        );
        $this->db = $this->client->selectDatabase($config['mongo_database']);
    }


    /**
     * @param string $databaseName
     * @return Database
     */
    public function selectDatabase(string $databaseName): Database
    {
        // Select the database
        return $this->client->selectDatabase($databaseName);
    }

    /**
     * @param string $collectionName
     * @return void
     */
    public function getCollection(string $collectionName): void
    {
        // Set the collection
        $this->collection = $this->db->selectCollection($collectionName);
    }

    /**
     * @param object $data
     * @return void
     */
    protected function insertData(object $data): void
    {
        // Insert data to the collection
        $this->collection->insertOne($data);
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        $res = [];
        // Get all products from the collection _id field is excluded
        $products = $this->collection->find([], ['projection' => ['_id' => 0]]);
        // Convert MongoDB cursor to array only with needed fields
        foreach ($products as $product) {
            $res[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'category' => $product['category']
            ];
        }
        return $res;
    }

}
