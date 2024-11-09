<?php

namespace App\requests;

use App\strategies\ProductAttribute\AttributeStrategyFactory;

class StoreProductRequest {
    private array $data;
    private array $errors = [];
    
    public function __construct() {
        $this->data = $_POST;
    }
    
    public function validate(): bool {
        if (empty($this->data['sku'])) {
            $this->errors['name'] = 'Product sku is required.';
        }

        if (empty($this->data['name'])) {
            $this->errors['name'] = 'Product name is required.';
        }
        
        if (!isset($this->data['price']) || !is_numeric($this->data['price'])) {
            $this->errors['price'] = 'Price must be a valid number.';
        }
        
        if (empty($this->data['productType'])) {
            $this->errors['productType'] = 'Product type is required.';
        }
        

        $this->validateAttributesByType();
        
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