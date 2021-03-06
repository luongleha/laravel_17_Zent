@extends('backend.layouts.master')

@section('content-header')
    <!-- Content Header -->
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Chi tiết người dùng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Người dùng</a></li>
                        <li class="breadcrumb-item active">Chi tiết người dùng</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 style="font-weight: 550;">
                <p>Id: {{$user->id}}</p>
                <p>Tên user: {{$user->name}}</p>
                <p>Email: {{$user->email}}</p>
                <p>Vị trí: 
                @if($user->is_admin == 1) Admin @endif
                @if($user->is_admin == 0) User @endif
                </p>
            <div class="col-lg-6">
                <h3>Ảnh user</h3>
                <img style="width: 120px" src="/{{$user->image}}" alt="">
            </div>
        </div>
    </div>
@endsection