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
}
