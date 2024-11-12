<?php

namespace  App\strategies\ProductAttribute;

class BookAttributeStrategy implements AttributeInterface
{
    public function format(string $attribute):string
    {
        return "Weight: {$attribute} KG";
    }

    public function validate(array $attribute):bool
    {
        return isset($attribute['weight']) && is_numeric($attribute['weight']);
    }

    public function set(array $attribute):string
    {
        return $attribute['weight'];
    }
}