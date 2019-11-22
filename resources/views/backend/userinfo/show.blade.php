@extends('backend.layouts.master')

@section('content-header')
    <!-- Content Header -->
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Chi tiết khách hàng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Khách hàng</a></li>
                        <li class="breadcrumb-item active">Chi tiết khách hàng</li>
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
                <p>Id: {{$userinfo->id}}</p>
                <p>Tên userinfo: {{$userinfo->name}}</p>
                <p>Email: {{$userinfo->email}}</p>
                <p>Số điện thoại: {{$userinfo->mobile}}</p>
                <p>Địa chỉ: {{$userinfo->address}}</p>
            <div class="col-lg-6">
                <h3>Ảnh userinfo</h3>
                <img style="width: 120px" src="/{{$userinfo->image}}" alt="">
            </div>
        </div>
    </div>
@endsection