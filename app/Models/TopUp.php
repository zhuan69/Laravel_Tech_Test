<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUp extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    protected $table = 'topup_history';

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'topup_id', 'id');
    }
}
