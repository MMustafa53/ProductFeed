<?php

namespace src\adapter;
class GoogleAdapter extends BaseAdapter implements APIInterface
{
    /**
     * @return array
     */
    public function getProducts(): array
    {
        $products = [];
        // We need to get the products from the database
        foreach ($this->getDBProducts() as $product) {
            // We need to convert the products to the format that Google API expects
            $products[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'google_price' => $product['price'],
                'category' => $product['category']
            ];
        }
        return $products;
    }
}