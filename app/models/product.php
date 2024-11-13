<?php

namespace App\models;

use App\core\model;
use App\factories\product\ProductFactory;
use App\strategies\ProductAttribute\AttributeStrategyFactory;

class product extends model
{
    protected $tableName = 'products';

    function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function getAll()
    {
        $products = $this->select()->get();
        $data = [];
        foreach ($products as $product) {
            $data[] = ProductFactory::createProduct(
                $product['type'],
                $product['sku'],
                $product['name'],
                $product['price'],
                $product['attribute'],
            )->toArray();
        }
        
        return $data;
    }

    public function create(array $requestData)
    {
        $product = ProductFactory::createProduct(
            $requestData['productType'],
            $requestData['sku'],
            $requestData['name'],
            $requestData['price'],
            $requestData
        )->toDatabaseArray();

        return $this->insert($product);
    }
}


