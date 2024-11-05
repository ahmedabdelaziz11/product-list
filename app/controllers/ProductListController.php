<?php

namespace App\controllers;

use App\core\controller;

class ProductListController extends controller{

    public function __construct()
    {
    }

    public function index(){
        $this->view('product-list/index');
    }
}