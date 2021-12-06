<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $product = Product::all();
        $status = 'success show all data';
        return response()->json(compact('status', 'product'),200);
    }
//filter
     public function filter(Request $request) 
     {
        $product_query = Product::with(['category']);
         
        if ($request->category) {
            $product_query->whereHas('category',function($query) use($request){
                $query->where('name', $request->category);
            });
        }

        $product = $product_query->get();
        return response()->json([
            'message' => 'successfully',
            'data' =>$product
        ], 200);
    }
//search 
     function search($name)
     {
         return Product::where("name","like","%".$name."%" ) ->get();
     }

     function searchLoc($location)
     {
         return Product::where("location","like","%".$location."%" ) ->get(); 
     }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createProduct(Request $request)
    {
        $data = $request->all();
             
        // $product = new Product;
        // $product->name = $data['name'];
        // $product->desc = $data['desc'];
        // $product->price = $data['price'];
        // $product->image = $data['image'];
        // $product->category_id = $data['category_id'];
        // $product->save();

        $request->validate([
            'name' => 'required',
            'user_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'location' => 'required',
            'category_id' => 'required',
            'image' => ' required|image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }

        Product::create($data);

            // $product = Product::all();
            $status = 'success create product';
            return response()->json(compact('status','data'), 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showById($id)
    {
        $product = Product::find($id);
        $status = 'success show product by id ';
        return response()->json(compact('status','product'),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request, Product $product)
    {
        $data = $request->all();

        if (isset($data['name'])&& !empty ($data['name'])) {
            $product->name = $data['name'];
        }

        if (isset($data['desc'])&& !empty ($data['desc'])) {
            $product->desc = $data['desc'];
        }

        if (isset($data['price'])&& !empty ($data['price'])) {
            $product->price = $data['price'];
        }

         if (isset($data['location'])&& !empty ($data['location'])) {
            $product->location = $data['location'];
        }

        if (isset($data['category_id'])&& !empty ($data['category_id'])) {
            $product->category_id = $data['category_id'];
        }

        if (isset($data['user_id'])&& !empty ($data['user_id'])) {
            $product->user_id = $data['user_id'];
        }

        if (isset($data['image'])&& !empty ($data['image'])) {
            $product->image = $data['image'];
        }

        $product->save();
        $status = "success update product";
        return response()->json(compact('status','product'),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($id)
    {
        $product =  Product::findOrFail($id);
        $product->delete();
        $status = "success delete product";
        return response()->json(compact('status','product'),200);
    }
}
