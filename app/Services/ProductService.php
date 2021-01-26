<?php
namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAllProduct()
    {
        $indexData = Product::all();
        return $indexData;
    }
    public function findByName($productName)
    {
        $resultData = Product::where('product_name', $productName)->firstOrFail();
        return $resultData;
    }
    public function findById($productId)
    {
        $resultData = Product::find($productId);
        return $resultData;
    }
}
