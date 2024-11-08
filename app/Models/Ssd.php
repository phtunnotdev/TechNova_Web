<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ssd extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "ssds";

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, "ssd_id");
    }

    // dùng để nối với các sản phẩm
    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}