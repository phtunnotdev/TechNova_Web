<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    
    protected $table = "product_variants";

    protected $fillable = [
        "image",
        "import_price",
        "listed_price",
        "price",
        "quantity",
        "color_id",
        "ssd_id",
        "product_id"
    ];

    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
 
    public function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }
 
    public function ssd(){
        return $this->belongsTo(SSD::class, 'ssd_id');
    }

    public function carts(){
        return $this->hasMany(Cart::class, 'variant_id');
    }
}