@extends('backend.layouts.master')

@section('content-header')
    <!-- Content Header -->
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh mục sản phẩm</h1>
                    @if(session()->has('success'))
                        <span>{{session()->get('success')}}</span>
                        @endif
                    @if(session()->has('error'))
                        <span>{{session()->get('error')}}</span>
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Danh mục sản phẩm</a></li>
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
                            <h3 class="card-title">Danh mục sản phẩm</h3>

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
                                    <th>Tên danh mục</th>
                                    <th>Mục cha</th>
                                    <th>Thời gian</th>
                                    <th>Dộ sâu</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($categories as $category)
                                   <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parent_id }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->depth }}</td>
                                       <td>
                                           {{--                                           <a style="display: inline-block; width: 67px;" href="{{route('todos.show', $item->id)}}" class="btn btn-warning">Show</a>--}}
                                           <a href="{{ route('backend.categories.show', $category->id) }}" class="btn btn-info">Detail</a>
                                           <a style="display: inline-block; width: 67px;" href="{{route('backend.categories.edit', $category->id)}}" class="btn btn-success">Edit</a>
                                           <form style="display: inline-block;" action="{{route('backend.categories.destroy', $category->id)}}" method="post" accept-charset="utf-8">
                                               @csrf
                                               {{method_field('delete')}}
                                               <button type="submit" class="btn btn-danger">Delete</button>
                                           </form>
                                       </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {!! $categories->links() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
@endsection
