<?php
namespace App\factories\product;

use App\constants\ProductType;

class Book extends Product
{
    public function __construct($sku, $name, $price, $attribute)
    {
        parent::__construct($sku, $name, $price, ProductType::Book, $attribute);
    }

    public function getType()
    {
        return ProductType::Book;
    }

    public function getAttribute()
    {
        $attributes = json_decode($this->attribute, true);
        return 'Weight: ' . $attributes['weight'] . 'Kg';
    }

    public function setAttribute($attribute)
    {
        $this->attribute = json_encode(['weight' => $attribute['weight']]);
    }

    public static function validateAttributes($attributes)
    {
        return isset($attributes['weight']) && is_numeric($attributes['weight']);
    }

    public function toDatabaseArray()
    {
        $array = parent::toDatabaseArray();
        $array['attribute'] = json_encode(['weight' => $this->attribute['weight']]);
        return $array;
    }
}