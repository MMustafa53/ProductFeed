<?php
namespace src\adapter;

interface APIInterface
{
    /**
     * @return array
     */
    public function getProducts(): array;
}