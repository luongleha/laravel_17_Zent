@extends('backend.layouts.master')

@section('content-header')
    <!-- Content Header -->
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách khách hàng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Khách hàng</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('content')
    <!-- Content -->
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách khách hàng</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Thời gian</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($userinfo as $userinfo2)
                                <tr>
                                    <td>{{ $userinfo2->id }}</td>
                                    <td>{{ $userinfo2->fullname }}</td>
                                    <td>{{ $userinfo2->email }}</td>
                                    <td>{{ $userinfo2->mobile }}</td>
                                    <td>{{ $userinfo2->address }}</td>
                                    <td>{{ $userinfo2->created_at }}</td>
                                    <td>
                                        {{-- <a style="display: inline-block; width: 67px;" href="{{ route('backend.userinfo.show',$userinfo->id) }}" class="btn btn-success">Show</a> --}}
                                        <a href="{{ route('backend.userinfo.show', $userinfo->id) }}" class="btn btn-info">Detail</a>
                                        <a style="display: inline-block; width: 67px;" href="{{ route('backend.userinfo.edit',$userinfo->id) }}" class="btn btn-warning">Edit</a>

                                        <form style="display: inline-block;" action="{{ route('backend.userinfo.destroy', $userinfo->id) }}" method="post" accept-charset="utf-8">
                                            @csrf
                                            {{method_field('delete')}}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {!! $userinfo->links() !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection