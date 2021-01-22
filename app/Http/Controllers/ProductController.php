<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    public function indexProduct()
    {
        $resultIndex = (new ProductService())->getAllProduct();
        return view('product-list', compact('resultIndex'));
    }
}
