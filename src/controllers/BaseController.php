<?php

namespace src\controllers;

use src\db\MongoDBClient;

class BaseController
{
    protected mixed $adapter;

    /**
     * @param mixed $adapter
     */
    public function __construct(mixed $adapter)
    {
        $this->adapter = new $adapter();
    }

    /**
     * @return mixed
     */
    public function getList(): mixed
    {
        return $this->adapter->getProducts();

    }

    /**
     * @return void
     */
    public static function checkToken(): void
    {
        $headers = getallheaders();
        if (!isset($headers['Api-Token'])) {
            include 'src/views/401.php';
            exit(0);
        }

        $apiToken = $headers['Api-Token'];
        $mongoDBClient = new MongoDBClient();
        $token = $mongoDBClient->selectDatabase('products')->selectCollection('tokens')->findOne(['token' => $apiToken]);
        if (!$token) {
            include 'src/views/401.php';
            exit(0);
        }
    }
}