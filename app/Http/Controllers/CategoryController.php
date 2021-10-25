<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
   
    public function showAll()
    {
        // show all data
        $category = Category::all();
        $status = "success show all data";
        return response()->json(compact('status','category'),200);
    }

    public function showById($id)
    {
        $category = Category::find($id);
        $status = "success show id";
        return response()->json(compact('status','category'),200);
    }
    
}
