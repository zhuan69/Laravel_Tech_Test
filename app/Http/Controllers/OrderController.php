<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function getHistoryOrderPage(Request $request)
    {
        $userId = Auth::user()->id;
        $resultHistory = $this->orderService->getHistoryOrder($userId);
        return view('order-history', compact('resultHistory'));
    }
}
