<?php

namespace  App\strategies\ProductAttribute;

use App\constants\ProductType;

class AttributeStrategyFactory
{
    private const TYPES = [
        ProductType::DVD       => DVDAttributeStrategy::class,
        ProductType::Book      => BookAttributeStrategy::class,
        ProductType::Furniture => FurnitureAttributeStrategy::class,
    ];

    public static function get($type,$attribute)
    {
        if(!array_key_exists($type,Self::TYPES)){
            throw new \Exception("Invalid type to get");
        }

        $type = Self::TYPES[$type];
        $strategy = new $type;
        return $strategy->get($attribute);
    }

    public static function validate($type,$attribute)
    {
        if(!array_key_exists($type,Self::TYPES)){
            throw new \Exception("Invalid type to format");
        }

        $type = Self::TYPES[$type];
        $strategy = new $type;
        return $strategy->validate($attribute);
    }

    public static function set($type,$attribute)
    {
        if(!array_key_exists($type,Self::TYPES)){
            throw new \Exception("Invalid type to format");
        }

        $type = Self::TYPES[$type];
        $strategy = new $type;
        return $strategy->set($attribute);
    }
}
