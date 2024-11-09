<?php

namespace  App\strategies\ProductAttribute;

class FurnitureAttributeStrategy implements AttributeInterface
{
    public function format(string $attribute):string
    {
        list($height, $width, $length) = explode(',', $attribute);
        return "Dimensions: {$height}x{$width}x{$length}";
    }

    public function validate(string $attribute):bool
    {
        return true;
    }
}