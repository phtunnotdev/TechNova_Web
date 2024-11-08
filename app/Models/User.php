<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Product;
use App\Models\Order;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes; //Sử dụng xóa mềm

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";

    protected $fillable = [
        'user_code',
        'name',
        'email',
        'phone',
        'image',
        'address',
        'status',
        'show_password',
        'role',
        'password',
        'deleted_at'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
  
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }
    // Nối wishlist vs user
    // public function wishlistItems()
    // {
    //     return $this->belongsToMany(Product::class, 'wishlist_items', 'user_id', 'product_id');
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
