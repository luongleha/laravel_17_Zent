<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::get();
        $users = User::paginate(15);
        // $users = User::simplePaginate(15);

        return view('backend.users.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('view-dashboard')) {
            return view('backend.users.create');
        }else{
            return abort(404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info_image = [];
        if ($request->hasFile('image')){
            $images = $request->file('image');
            foreach ($images as $key => $image){

//                cach 1
//                $id = $key;
//                $namefile = $id . '.png';

//                cach2
                $namefile = $image->getClientOriginalName();
                $url = 'storage/user/' . $namefile;
                Storage::disk('public')->putFileAs('user', $image, $namefile);
                $info_image[] = [
                    'url' => $url,
                    'name' => $namefile
                ];
            }
        }
        else{
            dd('khong co file');
        }

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->get('is_admin');
        $user->image = $url;
        // dd($user);
        // dd(1);
        $save = $user->save();
        if ($save) {
            $request->session()->flash('success', 'Tạo user thành công' . '<br>');
        } else {
            $request->session()->flash('fail', 'Tạo user thất bại' . '<br>');
        }

        return redirect()->route('backend.user.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        // $user = User::find($id);
        // $userInfo = $user->userInfo;
        // dd($userInfo);

        $userInfo = UserInfo::find($id);
        $user = $userInfo->user;
        dd($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.users.edit')->with('user', $user);
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
        $name = $request->get('name');
        $email = $request->get('email');
        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $save = $user->save();
        if ($save) {
            $request->session()->flash('success_update', 'Cập nhật user thành công' . '<br>');
        } else {
            $request->session()->flash('fail_update', 'Cập nhật user thất bại' . '<br>');
        }
        return redirect()->route('backend.user.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('backend.user.index');
    }
}
