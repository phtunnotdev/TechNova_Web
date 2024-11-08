<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideShowGallery extends Model
{
    use HasFactory;

    protected $table = "slide_show_galleries";

    protected $fillable = [
        "image",
        "link",
        "slide_show_id"
    ];
    
    public $timestamps = false;

    public function slideShow(){
        return $this->belongsTo(SlideShow::class, 'slide_show_id');
    }
}