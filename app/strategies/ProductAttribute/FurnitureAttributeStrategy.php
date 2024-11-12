<?php

namespace  App\strategies\ProductAttribute;

class FurnitureAttributeStrategy implements AttributeInterface
{
    public function format(string $attribute):string
    {
        list($height, $width, $length) = explode(',', $attribute);
        return "Dimensions: {$height}x{$width}x{$length}";
    }

    public function validate(array $attribute):bool
    {
        return isset($attribute['height']) 
            && is_numeric($attribute['height']) 
            && isset($attribute['width'])
            && is_numeric($attribute['width']) 
            && isset($attribute['length'])
            && is_numeric($attribute['length']);
    }

    public function set(array $attribute):string
    {
        return $attribute['length'] . ',' . $attribute['width'] . ',' . $attribute['height'];
    }
}