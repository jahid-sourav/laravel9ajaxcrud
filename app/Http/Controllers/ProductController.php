<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //View Product
    public function products()
    {
        $products = Product::latest()->paginate(2);
        return view('products', compact('products'));
    }
    //Add Product
    public function addProduct(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:products',
                'price' => 'required',
            ],
            [
                'name.required' => 'Name is Required!',
                'name.unique' => 'Product name already Exists!',
                'price.required' => 'Price is Required!',
            ]
        );
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json([
            'status' => 'success',
        ]);
    }
    //Update Product
    public function updateProduct(Request $request)
    {
        $request->validate(
            [
                'update_name' => 'required|unique:products,name,'.$request->update_id,
                'update_price' => 'required',
            ],
            [
                'update_name.required' => 'Name is Required!',
                'update_name.unique' => 'Product name already Exists!',
                'update_price.required' => 'Price is Required!',
            ]
        );
        Product::where('id',$request->update_id)->update([
            'name'=>$request->update_name,
            'price'=>$request->update_price,
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }
    //Delete Product
    public function deleteProduct(Request $request){
        Product::find($request->product_id)->delete();
        return response()->json([
           'status' => 'success',
        ]);
    }
    //Pagination
    public function pagination(Request $request){
        $products = Product::latest()->paginate(2);
        return view('paginationData', compact('products'))->render();
    }
    //Search
    public function searchProduct(Request $request){
        $products = Product::where('name', 'like', '%'.$request->search_string.'%')
        ->orwhere('price', 'like', '%'.$request->search_string.'%')
        ->orderBy('id','desc')
        ->paginate(2);
        if($products->count()>=1){
            return view('paginationData', compact('products'))->render();
        }else{
            return response()->json([
               'status'=>'nothing_found',
            ]);
        }
    }
}
