<?php
namespace App\Services;

use App\Models\Order;
use App\Services\ProductService;
use App\Services\TopUpService;
use App\Services\UsersService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

class OrderService
{
    protected $usersService;
    protected $productService;
    protected $topUpService;
    public function __construct(UsersService $usersService, ProductService $productService, TopUpService $topUpService)
    {
        $this->usersService = $usersService;
        $this->productService = $productService;
        $this->topUpService = $topUpService;
    }

    public function getHistoryOrder(int $userId)
    {
        $getIndexOrder = Order::where('users_id', $userId)
            ->with(['user', 'product', 'topUpHistory'])
            ->orderByDesc('order_date')
            ->paginate(20);
        return $getIndexOrder;
    }

    public function topUpOrder($userId, $value)
    {
        $topUpData = $this->topUpService->topUpBalance($value, $userId);
        if ($topUpData['message'] === 'Failed') {
            $value['order_status'] = 'Failed';
        } else {
            $value['order_status'] = 'Success';
            (int) $value['price'] += ((int) $value['price'] * 0.05);
        }
        $value['topup_id'] = $topUpData['data']->id;
        $createOrder = $this->createOrder($userId, $value);
        return $createOrder;
    }

    public function productOrder($userId, $value)
    {
        $productData = $this->productService->findByName($value['product_name']);
        $productId = $productData->id;
        $value['product_id'] = $productId;
        (int) $value['price'] += 10000;
        $value['order_status'] = 'Success';
        $createOrder = $this->createOrder($userId, $value);
        return $createOrder;
    }

    private function generateShippingCode()
    {
        $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($character);
        $lengthCode = 8;
        $shipCode = '';
        for ($i = 0; $i < $lengthCode; $i++) {
            $generateCode = $character[mt_rand(0, $charLength - 1)];
            $shipCode .= $generateCode;
        }
        return $shipCode;
    }

    private function createOrder($userId, $value)
    {
        $randomNumber = mt_rand(1000000000, 9999999999);
        $currentDay = Carbon::now();
        $orderId = Str::uuid();
        try {
            if (isset($value['product_id'])) {
                $shippingCode = $this->generateShippingCode();
                $newOrder = Order::create([
                    'id' => $orderId,
                    'shipping_code' => $shippingCode,
                    'order_no' => $randomNumber,
                    'total_price' => $value['price'],
                    'order_date' => $currentDay,
                    'order_status' => $value['order_status'],
                    'users_id' => $userId,
                    'product_id' => $value['product_id'],
                ]);
                return $newOrder;
            }
            $newOrder = Order::create([
                'id' => $orderId,
                'order_no' => $randomNumber,
                'total_price' => $value['price'],
                'order_date' => $currentDay,
                'order_status' => $value['order_status'],
                'users_id' => $userId,
                'topup_id' => $value['topup_id'],
            ]);
            return $newOrder;
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
