<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use App\Model\User;
use App\Models\Product;
use App\Models\UserInfor;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        lay mot san pham
//        $item = Cart::add('12345', 'Product 1', 1, 1000, 0, ['size' => '990']);
//        $item = Cart::add('12346', 'Product 3', 1, 1000, 0, ['size' => '990']);
        $items = Cart::content();
                     //dd($items);



////        lay nhieu san pham
//        $item = Cart::add([
//            ['id' => '12355', 'name' => 'Product 1', 'qty' => 1, 'price' => 10000, 'weight'=>0],
//            ['id' => '12455', 'name' => 'Product 2', 'qty' => 1, 'price' => 10000, 'weight'=>0]
//        ]);
//      Cart::destroy();
//        dd($item);

//        $item = Cart::content();
//                dd($item);
        return view('frontend.cart.index')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add2Cart($id)
    {
        $product = Product::find($id);
        Cart::add($product->id, $product->name, 1, $product->sale_price, 0);
//        $item = Cart::add('12345', 'Product 1', 1, 1000, 0, ['image' => 'aaaaa']);
        return redirect()->route('frontend.cart.index');
    }

    public function pay()
    {
        $items = Cart::content();
        return view('frontend.cart.pay')->with(['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $items = Cart::content();
        return view('frontend.cart.pay')->with(['items' => $items]);
    }
    public function store(Request $request)
    {
        $userinfo = new Userinfor();
        $userinfo->fullname = $request->get('fullname');
        $userinfo->email = $request->get('email');
        $userinfo->phone = $request->get('phone');
        $userinfo->address = $request->get('address');
        dd($userinfo);
        dd(1);
        $save = $userinfo->save();
    }

    public function destroy($id){
        Cart::destroy($id);
        return redirect()->route('frontend.cart.index');
    }

}
