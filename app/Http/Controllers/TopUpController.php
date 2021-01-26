<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::user()->id;
        $resultTopUp = $this->orderService->topUpOrder($userId, $inputBody);
        return dd($resultTopUp);
    }
}
