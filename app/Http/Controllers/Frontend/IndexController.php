<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $products = Product::with('images', 'category')->paginate(15);
        return view('frontend.index')->with([
            'products' => $products
        ]);
    }
}
