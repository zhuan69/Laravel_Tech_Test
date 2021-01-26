<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    protected $orderService;
    protected $paymentService;

    public function __construct(OrderService $orderService, PaymentService $paymentService)
    {
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
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
        $resultTopUp['phone'] = $inputBody['phone_number'];
        $resultTopUp['value'] = $inputBody['price'];
        $redirectPayPage = $this->paymentService->redirectPayPage($resultTopUp);
        return $redirectPayPage;
    }
}
