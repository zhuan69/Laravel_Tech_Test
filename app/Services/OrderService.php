<?php
namespace App\Services;

use App\Models\Order;
use App\Services\ProductService;
use App\Services\UsersService;
use Carbon\Carbon;
use Exception;

class OrderService
{
    protected $usersService;
    protected $productService;
    public function __construct(UsersService $usersService, ProductService $productService)
    {
        $this->usersService = $usersService;
        $this->productService = $productService;
    }

    public function makeOrder($userId, $value)
    {
        if ($value['product_name']) {
            $productData = $this->productService->findByName($value['product_name']);
            $productId = $productData->id;
            $createOrder = $this->createOrder($userId, $value, $productId);
            return $createOrder;
        }
        $createOrder = $this->createOrder($userId, $value);
        return $createOrder;
    }
    private function createOrder($userId, $value, $productId = null)
    {
        $randomNumber = mt_rand(1000000000, 9999999999);
        $currentDay = Carbon::today();
        $orderType = $value['order_type'];
        try { $newOrder = Order::create([
            'order_no' => $randomNumber,
            'total_price' => $value['total_price'],
            'order_date' => $currentDay,
            'order_type' => $orderType,
            'users_id' => $userId,
            'product_id' => $productId,
        ]);
            return $newOrder;
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
