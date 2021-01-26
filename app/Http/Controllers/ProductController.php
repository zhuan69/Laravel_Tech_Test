<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;
    protected $orderService;
    protected $paymentService;

    public function __construct(ProductService $productService, OrderService $orderService, PaymentService $paymentService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
    }

    public function indexProduct()
    {
        $resultIndex = $this->productService->getAllProduct();
        return view('product-list', compact('resultIndex'));
    }

    public function orderProduct(Request $request)
    {
        $inputBody = $request->all();
        $userId = Auth::user()->id;
        $orderResult = $this->orderService->productOrder($userId, $inputBody);
        $orderResult['product_name'] = $inputBody['product_name'];
        $orderResult['address'] = $inputBody['shipping_address'];
        $redirectPaymentPage = $this->paymentService->redirectPayPage($orderResult);
        return $redirectPaymentPage;
    }
}
