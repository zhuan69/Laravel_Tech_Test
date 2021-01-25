<?php

namespace App\Http\Controllers;

use App\Services\TopUpService;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    protected $topUpService;

    public function __construct(TopUpService $topUpService)
    {
        $this->topUpService = $topUpService;
    }

    public function getTopUpPage()
    {
        $phonePrefix = "081";
        return view('top-up', compact('phonePrefix'));
    }
    public function topUp(Request $request)
    {
        //$userId = $request->id();
        $resultTopUp = $this->topUpService->topUpBalance($request->all(), 1);
        return dd($resultTopUp);
    }
}
