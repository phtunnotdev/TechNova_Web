<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'voucher_id',
        'user_id',
        'order_id'
    ];

    public function voucher(){
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}