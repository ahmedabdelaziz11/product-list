<?php

namespace  App\strategies\ProductAttribute;

interface AttributeInterface
{
    public function format(string $attribute):string;
    public function validate(string $attribute):bool;
}
