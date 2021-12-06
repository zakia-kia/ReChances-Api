<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

     protected $fillable = [
        'name',
        'price',
        'desc',
        'image',
        'location',
        'user_id',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->hashMany(Order::class);
    }
}
