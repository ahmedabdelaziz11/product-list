<?php
namespace App\factories\product;

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $attribute;

    public function __construct($sku, $name, $price, $type, $attribute) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->attribute = $attribute;
    }

    public function getSku() {
        return $this->sku;
    }

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function toArray()
    {
        return [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'type' => $this->getType(),
            'attribute' => $this->getAttribute(),
        ];
    }

    public function toDatabaseArray()
    {
        return [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'type' => $this->getType(),
        ];
    }

    abstract public function getType();

    abstract public function getAttribute();

    abstract public function setAttribute($attribute);

    abstract public static function validateAttributes($attributes);
}
