@extends('backend.layouts.master')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tạo người dùng</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Người dùng</a></li>
                <li class="breadcrumb-item active">Tạo người dùng</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid">

    <form action="{{ route('backend.user.update', $user->id) }}" method="POST" class="" role="form">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <legend>Cập nhật user</legend>
        </div>
        <div class="form-group">
            <label class="control-label" for="todo">Tên user:</label>
            <input name="name" type="text" value="{{ $user->name }}" class="form-control" id="todo" placeholder="Enter user">
        </div>

        <div class="form-group">
            <label class="control-label" for="todo">Email:</label>
            <input name="email" type="text" value="{{ $user->email }}" class="form-control" id="todo" placeholder="Enter email">
        </div>

        {{--            <div class="form-group">--}}
            {{--                <label class="control-label" for="todo">Password:</label>--}}
            {{--                <input name="password" type="text" value="{{ $user->password }}" class="form-control" id="todo" placeholder="Enter password">--}}
        {{--            </div>--}}
        <div class="form-group">
            <label for="exampleInputFile">Hình ảnh user</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image[]">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="">
                <a href="{{ route('backend.user.index') }}" class="btn btn-default">Huỷ bỏ</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection