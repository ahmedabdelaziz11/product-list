<?php

namespace App\models;

use App\core\model;
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
        foreach ($products as &$product) {
            $product['attribute'] = AttributeStrategyFactory::get($product['type'],$product['attribute']);
        }
        return $products;
    }

    public function create(array $requestData)
    {
        $data = [
            'sku' => $requestData['sku'],
            'name' => $requestData['name'],
            'price' => $requestData['price'],
            'type' => $requestData['productType'],
            'attribute' => AttributeStrategyFactory::set($requestData['productType'],$requestData),
        ];

        return $this->insert($data);
    }
}


