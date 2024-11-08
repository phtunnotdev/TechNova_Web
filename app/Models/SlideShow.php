<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    use HasFactory;

    protected $table = "slide_shows";

    protected $fillable = [
        "name",
        "link_one",
        "link_two",
        "link_three",
        "image_one",
        "image_two",
        "image_three",
        "arrows",
        "dots",
        "active"
    ];
    
    public function slideShowGalleries(){
        return $this->hasMany(SlideShowGallery::class, 'slide_show_id');
    }
}