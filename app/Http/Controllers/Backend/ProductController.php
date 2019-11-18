<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);
        //        -----------su dung gates-----------
        $categories = Category::get();

//        session()->keep(['success']);
//        session()->flush();
//        session()->reflash();
//        session()->forget('suceess');

        if (Gate::allows('view-dashboard')) {
            return view('backend.products.index')->with([
                'products' => $products
            ]);
        }else{
            return abort(404);
        }
//        --------------
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        -----------su dung gates-----------
        $categories = Category::get();
        if (Gate::allows('view-dashboard')) {
            return view('backend.products.create')->with([
                'categories' => $categories
            ]);
        }else{
            return abort(404);
        }
//        --------------
//        Storage::disk('local')->put('test1.txt', 'Contents');
//        Storage::disk('public')->put('test1.txt', 'Contents');
//        Storage::put('test1.txt', 'Contents');
        $contents = Storage::get('test1.txt');
//        dd($contents);
        $exists = Storage::disk('local')->exists('test1.txt');
//        dd($exists);
//        return Storage::download('test1.txt');
//        return Storage::download('test1.txt', $name, $headers);
//        Storage::copy('public/test1.txt', 'image/test1.txt');
//        Storage::move('test1.txt', 'image/test1.txt');
//        dd(1);
         $categories = Category::get();
        return view('backend.products.create')->with([
            'categories' => $categories
        ]);
        // return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // public function store(Request $request)
    public function store(StoreProductRequest $request)
    {
       //dd($request->all());
        $info_image = [];
        if ($request->hasFile('image')){
            $images = $request->file('image');
            foreach ($images as $key => $image){

//                cach 1
//                $id = $key;
//                $namefile = $id . '.png';

//                cach2
                $namefile = $image->getClientOriginalName();
                $url = 'storage/product/' . $namefile;
                Storage::disk('public')->putFileAs('product', $image, $namefile);
                $info_image[] = [
                    'url' => $url,
                    'name' => $namefile
                ];
            }
        }
        else{
            dd('khong co file');
        }


//        dd(1);
        // Validator::make($request,$pattern,$messenger,$customName);​
        // $validator = Validator::make($request->all(),
        //     [
        //         'name'         => 'required|min:10|max:255',
        //         'content'         => 'required|min:10|max:255',
        //         'origin_price' => 'required|numeric',
        //         'sale_price'   => 'required|numeric',
        //     ],
        //     [
        //         'required' => ':attribute Không được để trống',
        //         'min' => ':attribute Không được nhỏ hơn :min',
        //         'max' => ':attribute Không được lớn hơn :max'
        //     ],
        //     [
        //         'name' => 'Tên sản phẩm',
        //         'content' => 'Mo ta sản phẩm',
        //         'origin_price' => 'Giá gốc',
        //         'sale_price' => 'Giá bán'
        //     ]
        // );
//        if ($validator->errors()){
//            return back()
//                ->withErrors($validator)
//                ->withInput();
//        }

        $product = new Product();
        $product->name = $request->get('name');
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $request->get('category_id');
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->content = $request->get('content');
        $product->status = $request->get('status');
        $product->user_id = Auth::user()->id;
        $save = $product->save();

        foreach ($info_image as $img){
            $path = $img['url'];
            $name = $img['name'];
            Image::create([
                'product_id' => $product->id,
                'path' => $path,
                'name' => $name,
            ]);
        }

        if ($save){
            $request->session()->flash('success', 'Tao san pham thanh cong');
        }else{
            $request->session()->flash('error', 'Tao san pham that bai');
        }


        // dd($product);
        return redirect()->route('backend.product.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        // dd($product);
        $category = Category::find($product->category_id);
        $product_iamges = Product::with('images')->find($id);
        $path = $product_iamges->images;
        return view('backend.products.show')->with([
            'product' => $product,
            'category' => $category,
            'path' => $path
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $user = Auth::user();
//        $categories = Category::get();
//        $product = Product::find($id);
//        if ($user->can('update', $product)){
//            return view('backend.products.edit')->with('product', $product)->with([
//                'categories' => $categories
//            ]);
//        }else{
//            dd(2);
//        }


//        -----------su dung gates-----------
        $categories = Category::get();
        $product = Product::find($id);
        if (Gate::allows('update-product', $product)) {
            return view('backend.products.edit')->with('product', $product)->with([
                'categories' => $categories,
                'product' => $product
            ]);
        }else{
            return abort(404);
        }
//        --------------

        // Lấy dữ liệu với $id
        $product = Product::find($id);
        // Lấy dữ liệu categories
        $categories = Category::get();
        // Gọi đến view edit
        return view('backend.products.edit')->with('product', $product)->with([
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:10|max:255',
                'origin_price' => 'required|numeric',
                'sale_price' => 'required|numeric',
                'category_id' => 'required',
                'status' => 'required',
//              'images.*' => 'image|max:2000',
//              'images' => 'required'
            ],
            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min',
                'max' => ':attribute Không được lớn hơn :max',
//              'image' => ':attribute Không dung dinh dang'
            ],
            [
                'name' => 'Tên sản phẩm',
                'origin_price' => 'Giá gốc',
                'sale_price' => 'Giá bán',
                'category_id' => 'Danh mục',
                'status' => 'Trạng thái'
            ]
        );
        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $info_image = [];
        if ($request->hasFile('image')){
            $images = $request->file('image');
            foreach ($images as $key => $image){

//                cach 1
//                $id = $key;
//                $namefile = $id . '.png';

//                cach2
                $namefile = $image->getClientOriginalName();
                $url = 'storage/product/' . $namefile;
                Storage::disk('public')->putFileAs('product', $image, $namefile);
                $info_image[] = [
                    'url' => $url,
                    'name' => $namefile
                ];
            }
        }
        // Nhận dữ liệu từ $request
        $name = $request->get('name');
        $slug = $request->get('slug');
        $category_id = $request->get('category_id');
        $origin_price = $request->get('origin_price');
        $sale_price = $request->get('sale_price');
        $content = $request->get('content');

        // dump($title);
        // dump($content);
        // dump($status);

        // dd();

        // Tìm product tương ứng với id
        $product = Product::find($id);
        //Cập nhật dữ liệu mới
        $product->name = $name;
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $category_id;
        $product->origin_price = $origin_price;
        $product->sale_price = $sale_price;
        $product->content = $content;


        // Lưu dữ liệu
        $save = $product->save();
        Image::where('product_id', $product->id)->delete();
        //dd($info_image);
        foreach ($info_image as $img){
            $path = $img['url'];
            $name = $img['name'];
            Image::create([
                'product_id' => $product->id,
                'path' => $path,
                'name' => $name,
            ]);
            // $image = new Image();
            // $image->product_id = $id;
            // $image->path = $path;
            // $image->save();
        }

        if ($save){
            $request->session()->flash('success', 'Cap nhat san pham thanh cong');
        }else{
            $request->session()->flash('error', 'Cap nhat san pham that bai');
        }
        //Chuyển hướng đến trang danh sách
        return redirect()->route('backend.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Xoá với id tương ứng
        Product::destroy($id);
        // Chuyển hướng về trang danh sách
        return redirect()->route('backend.product.index');
    }
}
