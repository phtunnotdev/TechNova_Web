<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'order_code',
        'status',
        'payment_method',
        'payment_status',
        'total_price',
        'user_name',
        'user_phone',
        'user_address',
        'note',
        'voucher_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'order_id')->orderByDesc('id');
    }

    public function orderHistories(){
        return $this->hasMany(OrderHistory::class, "order_id");
    }
}