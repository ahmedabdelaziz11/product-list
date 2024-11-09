<?php

namespace App\controllers;

use App\core\controller;
use App\Helpers\Response;
use App\Models\Product;
use App\requests\DeleteProductRequest;
use App\requests\StoreProductRequest;

class ProductController extends controller
{
    public function index()
    {
        $this->view('product/index');
    }

    public function create()
    {
        $this->view('product/create');
    }

    public function list()
    {
        $productModel = new Product();
        $products = $productModel->getAll();
        echo json_encode($products);
    }

    public function store()
    {
        $request = new StoreProductRequest();
        if (!$request->validate()) {
            Response::jsonResponse([
                'status' => false,
                'message' => $request->errors()
            ], 400);
            return;
        }
    }

    public function delete()
    {
        $request = new DeleteProductRequest();
        if (!$request->validate()) {
            Response::jsonResponse([
                'status' => false,
                'message' => $request->errors()
            ], 400);
            return;
        }

        $products = $_POST['products'];
        $productModel = new Product();
        foreach($products as $sku)
        {
            $productModel->delete('sku',$sku);
        }

        Response::jsonResponse([
            'status' => true,
            'message' => 'products deleted successfully'
        ], 200);
        return;
    }
}