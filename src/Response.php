<?php

namespace src;

use SimpleXMLElement;

class Response
{
    /**
     * @param array $data
     * @param int $status
     * @return array
     */
    public function success(array $data, int $status = 200): array
    {
        http_response_code($status);
        return $data;
    }

    /**
     * @param string $message
     * @param int $status
     * @return array
     */
    public function error(string $message, int $status = 400): array
    {
        http_response_code($status);
        return ['error' => $message];
    }

    /**
     * @param array $products
     * @param string $format
     * @return bool|string
     */
    public function responseData(array $products, string $format): bool|string
    {
        return match ($format) {
            'xml' => $this->getProductsXML($products),
            'yaml' => $this->getProductsYAML($products),
            'csv' => $this->getProductsCSV($products),
            default => $this->getProductsJSON($products)
        };
    }

    /**
     * @param array $products
     * @return bool|string
     */
    public function getProductsJSON(array $products): bool|string
    {
        header('Content-Type: application/json');
        return json_encode($products);
    }

    /**
     * @param array $products
     * @return bool|string
     */
    public function getProductsXML(array $products): bool|string
    {
        header('Content-Type: application/xml');
        $xml = new SimpleXMLElement('<products></products>');
        foreach ($products as $product) {
            $xmlProduct = $xml->addChild('product');
            foreach ($product as $key => $value) {
                $xmlProduct->addChild($key, $value);
            }
        }
        return $xml->asXML();
    }

    /**
     * @param array $products
     * @return string
     */
    public function getProductsYAML(array $products): string
    {
        header('Content-Type: application/yaml');
        $yamlString = "products:\n";
        foreach ($products as $product) {
            foreach ($product as $key => $value) {
                // find element index number
                $_index = array_search($key, array_keys($product));
                if ($_index % 4 === 0){
                    $yamlString .= "  - " . $key . ": " . $value . "\n";
                } else {
                    $yamlString .= "    " . $key . ": " . $value . "\n";
                }
            }
        }
        return $yamlString;
    }

    /**
     * @param array $products
     * @return string
     */
    public function getProductsCSV(array $products): string
    {
        header('Content-Type: application/csv');
        $csvString = "";
        foreach ($products as $index => $product) {
            if ($index === 0) {
                $csvString .= implode(',', array_keys($product)) . "\n";
            }
            foreach ($product as $key => $value) {
                // find element index number
                $_index = array_search($key, array_keys($product));
                if ($_index % 4 === 3){
                    $csvString .= $value . "\n";
                } else {
                    $csvString .= $value . ',';
                }
            }
        }
        return $csvString;
    }

}