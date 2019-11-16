<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index($id)
    // {
    //     $product = Product::find($id);
    //     $category = Category::find($product->category_id);
    //     $product_iamges = Product::with('images')->find($id);
    //     $path = $product_iamges->images;
    //     return view('frontend.products.index')->with([
    //         'products' => $products
    //     ]);
    // }
    public function show($slug) {
        $product = Product::where('slug', $slug)->first();
        $products = Product::get();
        $product = Product::with('images')->where('slug', $slug)->first();
        $images = $product->images;
        // dd($images);
        // foreach ($images as $image) {
        //  dd($image);
        // }
        $category = Category::get();
        return view('frontend.products.index')->with([
            'products' => $products,
            'product' => $product,
            'category' => $category,
            'images' => $images,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id) {
        //$product = Product::get();
        $categories = Category::get(); //
        // $categories = Cache::remember('categories', 10, function () {
        //  return Category::get();
        // }); //
        $product10 = Category::with('product')->find($id);
        $product_cate = $product10->product;
        // foreach ($images as $image) {
        //  dd($image);
        // }
        //dd($product_cate);
        return view('fontend.category.index')->with([
            'product_cate' => $product_cate,
            'categories' => $categories,
        ]);
    }
}
