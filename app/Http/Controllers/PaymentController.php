<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $orderService;
    public function __construct(PaymentService $paymentService, OrderService $orderService)
    {
        $this->paymentService = $paymentService;
        $this->orderService = $orderService;
    }

    public function getPayOrderPage(Request $request, $id)
    {
        $orderId = $id;
        $order = $this->orderService->findById($orderId);
        return view('pay-order', compact('order'));
    }

    public function createPayment(Request $request, $id)
    {
        $value = [
            'order_id' => $id,
            'status' => 'Success',
        ];
        $resultPayment = $this->paymentService->createPaymentHistory($value);
        return $resultPayment;
    }
}
