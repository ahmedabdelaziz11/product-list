<?php

namespace App\requests;

class DeleteProductRequest {
    private array $data;
    private array $errors = [];
    
    public function __construct() {
        $this->data = $_POST;
    }
    
    public function validate(): bool {
        if (!isset($this->data['products']) || $this->data['products'] == []) {
            $this->errors['products'] = 'Products is required.';
        }
        
        return empty($this->errors);
    }

    public function errors(): array {
        return $this->errors;
    }
}