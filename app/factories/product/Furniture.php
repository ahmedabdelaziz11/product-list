<?php

namespace App\factories\product;

use App\constants\ProductType;

class Furniture extends Product
{
    public function __construct($sku, $name, $price,$attributes)
    {
        parent::__construct($sku, $name, $price, ProductType::Furniture, $attributes);
    }

    public function getType()
    {
        return ProductType::Furniture;
    }

    public function getAttribute()
    {
        $attributes = json_decode($this->attribute, true);
        return "Dimension: {$attributes['height']}x{$attributes['width']}x{$attributes['length']}";
    }

    public function setAttribute($attribute)
    {
        $this->attribute = json_encode([
            'height' => $attribute['height'],
            'width' => $attribute['width'],
            'length' => $attribute['length']
        ]);
    }

    public static function validateAttributes($attributes)
    {
        return isset($attributes['height'], $attributes['width'], $attributes['length']) &&
            is_numeric($attributes['height']) &&
            is_numeric($attributes['width']) &&
            is_numeric($attributes['length']);
    }

    public function toDatabaseArray()
    {
        $array = parent::toDatabaseArray();
        $array['attribute'] = json_encode([
            'width'  => $this->attribute['width'],
            'height' => $this->attribute['height'],
            'length' => $this->attribute['length'],
        ]);
        return $array;
    }
}
