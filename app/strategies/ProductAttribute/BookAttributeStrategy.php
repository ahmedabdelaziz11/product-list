<?php

namespace  App\strategies\ProductAttribute;

class BookAttributeStrategy implements AttributeInterface
{
    public function format(string $attribute):string
    {
        return "Weight: {$attribute} KG";
    }

    public function validate(string $attribute):bool
    {
        return true;
    }
}