<?php

namespace App\Models;

use App\core\model;
use App\strategies\ProductAttribute\AttributeStrategyFactory;

class Product extends model
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
            $product['attribute'] = AttributeStrategyFactory::format($product['type'],$product['attribute']);
        }
        return $products;
    }
}


