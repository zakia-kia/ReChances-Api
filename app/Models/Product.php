<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

     protected $fillable = [
        'name',
        'price',
        'desc',
        'image',
        'category_id'
    ];

    public function category(){
        return $this->hashMany(Category::class);
    }
}
