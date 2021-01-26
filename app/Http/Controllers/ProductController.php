<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $orderService;

    public function __construct(ProductService $productService, OrderService $orderService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
    }

    public function indexProduct()
    {
        $resultIndex = $this->productService->getAllProduct();
        return view('product-list', compact('resultIndex'));
    }

    public function orderProduct(Request $request)
    {
        $inputBody = $request->all();
        $orderResult = $this->orderService->productOrder(1, $inputBody);
        return dd($orderResult);
    }
}
