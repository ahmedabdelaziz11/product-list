<?php

namespace App\requests;

use App\constants\ProductType;
use App\models\product;
use App\strategies\ProductAttribute\AttributeStrategyFactory;

class StoreProductRequest {
    private array $data;
    private array $errors = [];
    
    public function __construct() {
        $this->data = $_POST;
    }
    
    public function validate(): bool {
        if (empty($this->data['sku'])) {
            $this->errors['sku'] = 'Product SKU is required.';
        }elseif((new product())->exists('sku',$this->data['sku'])){
            $this->errors['sku'] = 'Product SKU is already exists.';
        }

        if (empty($this->data['name'])) {
            $this->errors['name'] = 'Product name is required.';
        }
        
        if (!isset($this->data['price']) || !is_numeric($this->data['price'])) {
            $this->errors['price'] = 'Price must be a valid number.';
        }
        
        if (empty($this->data['productType'])) {
            $this->errors['productType'] = 'Product type is required.';
        }elseif(!in_array($this->data['productType'],[ProductType::Book,ProductType::DVD,ProductType::Furniture])){
            $this->errors['productType'] = 'Invalid product type selected.';
        }else{
            $this->validateAttributesByType();
        }
        
        
        return empty($this->errors);
    }

    private function validateAttributesByType(): void {
        try {
            $strategy = AttributeStrategyFactory::validate($this->data['productType'],$this->data);
            if (!$strategy) {
                $this->errors['attribute'] = 'Invalid attributes for type: ' . $this->data['productType'];
            }
        } catch (\Exception $e) {
            $this->errors['productType'] = 'Unsupported product type.';
        }
    }

    public function errors(): array {
        return $this->errors;
    }
}