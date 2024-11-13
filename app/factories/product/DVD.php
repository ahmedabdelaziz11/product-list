<?php
namespace App\factories\product;

use App\constants\ProductType;

class DVD extends Product
{
    public function __construct($sku, $name, $price, $attribute)
    {
        parent::__construct($sku, $name, $price, ProductType::DVD, $attribute);
    }

    public function getType()
    {
        return ProductType::DVD;
    }

    public function getAttribute()
    {
        $attributes = json_decode($this->attribute, true);
        return 'Size: ' . $attributes['size'] . ' MB';
    }

    public function setAttribute($attribute)
    {
        $this->attribute = json_encode(['size' => $attribute['size']]);
    }

    public static function validateAttributes($attributes)
    {
        return isset($attributes['size']) && is_numeric($attributes['size']);
    }

    public function toDatabaseArray()
    {
        $array = parent::toDatabaseArray();
        $array['attribute'] = json_encode(['size' => $this->attribute['size']]);
        return $array;
    }
}