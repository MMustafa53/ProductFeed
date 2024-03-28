<?php

namespace src\adapter;
class CimriAdapter extends BaseAdapter implements APIInterface
{
    /**
     * @return array
     */
    public function getProducts(): array
    {
        // We need to get the products from the database
        return $this->getDBProducts();
    }
}