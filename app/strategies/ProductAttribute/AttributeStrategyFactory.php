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

    public static function format($type,$attribute)
    {
        if(!array_key_exists($type,Self::TYPES)){
            throw new \Exception("Invalid type to format");
        }

        $type = Self::TYPES[$type];
        $formatter = new $type;
        return $formatter->format($attribute);
    }

    public static function validate($type,$attribute)
    {
        if(!array_key_exists($type,Self::TYPES)){
            throw new \Exception("Invalid type to format");
        }

        $type = Self::TYPES[$type];
        $formatter = new $type;
        return $formatter->validate($attribute);
    }

    public static function set($type,$attribute)
    {
        if(!array_key_exists($type,Self::TYPES)){
            throw new \Exception("Invalid type to format");
        }

        $type = Self::TYPES[$type];
        $formatter = new $type;
        return $formatter->set($attribute);
    }
}
