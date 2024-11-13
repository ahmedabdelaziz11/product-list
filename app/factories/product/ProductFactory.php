<?php

namespace  App\factories\product;

use App\constants\ProductType;

class ProductFactory
{
    private const TYPES = [
        ProductType::DVD       => DVD::class,
        ProductType::Book      => Book::class,
        ProductType::Furniture => Furniture::class,
    ];

    public static function createProduct(string $type, string $sku, string $name, float $price, mixed $attributes): Product
    {
        if (!array_key_exists($type, self::TYPES)) {
            throw new \Exception("Invalid type to get");
        }
        $productClass = self::TYPES[$type];
        return new $productClass($sku, $name, $price,$attributes);
    }

    public static function validateAttributes(string $type,$attributes)
    {
        if (!array_key_exists($type, self::TYPES)) {
            throw new \Exception("Invalid type to get");
        }
        $productClass = self::TYPES[$type];
        return $productClass::validateAttributes($attributes);
    }
}
