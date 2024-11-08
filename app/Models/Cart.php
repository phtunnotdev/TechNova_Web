<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';

    protected $fillable =
    [
        'user_id',
        'variant_id',
        'variant_quantity',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, "variant_id");
    }
}