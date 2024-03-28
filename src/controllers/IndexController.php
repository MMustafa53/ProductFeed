<?php
namespace src\controllers;

use Exception;

class IndexController extends BaseController
{

    /**
     * @param mixed $adapter
     */
    public function __construct(mixed $adapter)
    {
        parent::__construct($adapter);
    }
    /**
     * @return array
     */
    public function getProductList(): array
    {
        return $this->getList();
    }
}