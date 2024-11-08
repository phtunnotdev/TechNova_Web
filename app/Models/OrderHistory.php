<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    protected $table = "order_histories";
    protected $fillable = [
        'from_status',
        'to_status',
        'note',
        'by_user',
        'order_id'
    ];
    
    public function order(){
        return $this->belongsTo(Order::class, "order_id");
    }
}