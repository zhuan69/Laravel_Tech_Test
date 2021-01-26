<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function getHistoryOrderPage(Request $request)
    {
        $resultHistory = $this->orderService->getHistoryOrder(1);
        return view('order-history', compact('resultHistory'));
    }
}
