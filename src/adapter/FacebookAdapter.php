<?php

namespace src\adapter;
class FacebookAdapter extends BaseAdapter Implements APIInterface
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