<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function getTopUpPage()
    {
        $phonePrefix = "081";
        return view('top-up', compact('phonePrefix'));
    }
    public function topUp(Request $request)
    {
        $inputBody = $request->all();
        $resultTopUp = $this->orderService->topUpOrder(1, $inputBody);
        return dd($resultTopUp);
    }
}
