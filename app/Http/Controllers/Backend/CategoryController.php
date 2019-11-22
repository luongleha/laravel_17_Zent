<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Storage;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('backend.categories.index')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.categories.create')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories = new Category();
        $categories->name = $request->get('name');
        $categories->slugs = \Illuminate\Support\Str::slug($request->get('name'));
        $categories->parent_id = $request->get('parent_id');
        $categories->depth = $request->get('depth');
        $save = $categories->save();

        if ($save) {
            $request->session()->flash('success', 'tao moi danh muc thanh cong');
        }else{
            $request->session()->flash('error', 'tao moi danh muc that bai');
        }

        return redirect()->route('backend.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $categorys = Category::find($id)->products()->where('status', 2)->get();

        // // $category = Category::find($id);
        // // $categorys = $category->products;
        // //dd($categorys);

        // foreach ($categorys as $category) {
        //     echo $category->name . "<br>";
            
             $category = Category::find($id);
        return view('backend.categories.show')->with([
            'category' => $category
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
        // Lấy dữ liệu với $id
        $category = Category::find($id);
        // Lấy dữ liệu categories
        $categories = Category::get();
        // Gọi đến view edit
        return view('backend.categories.edit')->with('category', $category)->with([
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
        // Nhận dữ liệu từ $request
        $name = $request->get('name');
        $slugs = $request->get('slugs');
        $parent_id = $request->get('parent_id');
        $depth = $request->get('depth');

        // dump($title);
        // dump($content);
        // dump($status);

        // dd();

        // Tìm category tương ứng với id
        $category = Category::find($id);
        //Cập nhật dữ liệu mới
        $category->name = $name;
        $category->slugs = \Illuminate\Support\Str::slug($request->get('name'));
        $category->parent_id = $parent_id;
        $category->depth = $depth;

        // Lưu dữ liệu
        $save = $category->save();

        if ($save) {
            $request->session()->flash('success', 'sua danh muc thanh cong');
        }else{
            $request->session()->flash('error', 'sua danh muc that bai');
        }
        //Chuyển hướng đến trang danh sách
        return redirect()->route('backend.categories.index');
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
        Category::destroy($id);

//        if (Category::destroy($id)){
//            $id->session()->flash('success', 'xoa muc thanh cong');
//        }
        // Chuyển hướng về trang danh sách
        return redirect()->route('backend.categories.index');
    }
}
