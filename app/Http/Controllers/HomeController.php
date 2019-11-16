<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
//        $put = Cache::put('view_count', 1, 60*5);
//        cache voi array
//        $put = Cache::put('name', ['a' => 1, 'b' => 2], 60*5);
//        cache voi string
//        $put = Cache::put('name', 'Ha', 60*5);
//        Cache::put('age', 60*5);

//        cache voi int
//        Cache::put('age', '22', 20);

//        //        cache voi nhieu doi tuong
//        $cate = Category::find(1);
//        Cache::put('categories', $cate, 60*5);

//        cache voi nhieu doi tuong
        $categories = Category::get();
        $put = Cache::put('categories', $categories, 60*5);
//        dd(Cache::add('name', 'H', 60*5));

        dd($put);
        return view('frontend.index');
    }

//    public function getcache(){
//        $view_count = Cache::get('view_count');
//        echo $view_count . "\n";
//
//        Cache::increment('view_count');
//        Cache::increment('view_count');
//        Cache::decrement('view_count');
//
//        $name= Cache::get('name');
//        if (Cache::has('categories')){
//            $categories = Cache::get('categories');
//        }else{
//            $categories = Category::get();
//        }
//        $cate= Cache::get('$cate');
//        $categories= Cache::get('categories');
//        $age= Cache::get('age', 29);
//        echo "age: $age";
////        dd($categories);
//    }
        public function getcache(){
            $categories = Cache::remember('categories', 60*60, function() {
                return $categories = Category::get();
            });

//            top san pham
            $top_products = Cache::remember('top_products', 60, function() {
                return $roducts = Prodcuct::take(5)->get();
            });
            dd($categories);
        }
}
