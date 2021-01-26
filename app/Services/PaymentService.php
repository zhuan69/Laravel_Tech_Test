<?php
namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentService
{
    public function createPaymentHistory($value)
    {
        $id = Str::uuid();
        $createPayment = Payment::create([
            'id' => $id,
            'order_id' => $value['order_id'],
            'payment_status' => $value['status'],
        ]);
        return redirect('order-history');
    }
    public function redirectPayPage($order)
    {
        return response()->view('payment', compact('order'));
    }
}
