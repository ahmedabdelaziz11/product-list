<?php

namespace  App\strategies\ProductAttribute;

interface AttributeInterface
{
    public function format(string $attribute):string;
    public function validate(array $attribute):bool;
    public function set(array $attribute):string;
}
