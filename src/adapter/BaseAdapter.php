<?php

namespace src\adapter;

use src\db\MongoDBClient;

class BaseAdapter
{
    /**
     * @var MongoDBClient
     */
    protected MongoDBClient $mongoClient;

    /**
     *
     */
    public function __construct()
    {
        // Database connection
        $this->mongoClient = new MongoDBClient();
    }

    /**
     * @return array
     */
    public function getDBProducts(): array
    {
        // Firstly we need to set the collection
        $this->getCollection('products');
        // Then we can get the products
        return $this->mongoClient->getProducts();
    }

    /**
     * @param string $collectionName
     * @return void
     */
    protected function getCollection(string $collectionName): void
    {
        $this->mongoClient->getCollection($collectionName);
    }


}