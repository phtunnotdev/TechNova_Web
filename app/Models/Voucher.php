<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_code',
        'percent',
        'min_price',
        'max_price',
        'start_date',
        'end_date',
        'quantity',
        'used_quantity',
        'for_user_ids',
    ];

    public $timestamps = false;

    public function voucherHistories(){
        return $this->hasMany(VoucherHistory::class, 'voucher_id');
    }
}