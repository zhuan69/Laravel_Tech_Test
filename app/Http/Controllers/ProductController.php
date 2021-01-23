<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function indexProduct()
    {
        $resultIndex = $this->productService->getAllProduct();
        return view('product-list', compact('resultIndex'));
    }
}
