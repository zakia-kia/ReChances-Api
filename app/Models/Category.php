<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


class Category extends Model
{
    use HasFactory;
    protected $table = "categorys";
    
    protected $fillable = [
        'name'
    ];

    public function product(){
        return $this->hashMany(product::class);
    }
}
