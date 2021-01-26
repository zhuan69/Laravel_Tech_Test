<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    protected $table = 'payments';
    public $timestamps = false;

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
