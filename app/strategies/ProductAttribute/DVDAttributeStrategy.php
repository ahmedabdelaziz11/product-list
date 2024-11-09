<?php

namespace  App\strategies\ProductAttribute;

class DVDAttributeStrategy implements AttributeInterface
{
    public function format(string $attribute):string
    {
        return "Size: {$attribute} MB";
    }

    public function validate(array $attribute):bool
    {
        return true;
    }
}