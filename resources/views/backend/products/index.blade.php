@extends('backend.layouts.master')

@section('content-header')
<!-- Content Header -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Danh sách sản phẩm</h1>
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
                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
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
                    <h3 class="card-title">Sản phẩm mới nhập</h3>

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
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Thời gian</th>
                                {{-- <th>Mô tả</th> --}}
                                {{-- <th>Anh</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if(isset($product->category))
                                    {{ $product->category->name }}
                                    @else
                                    Khong co
                                    @endif
                                </td>
                                <td>{{ $product->user->name }}</td>
                                <td>
                                    @if($product->status == 0) Đang nhập @endif
                                    @if($product->status == 1)  Mở bán @endif
                                    @if($product->status == -1) Hết hàng @endif
                                </td>
                                <td>{{ $product->created_at }}</td>
                                {{-- <td>{{ $product->content }}</td> --}}
                                        {{-- <td>
                                        @if(count($product->images) > 0)
                                        <img src="/{{ $product->images->first()->path }}" alt="">
                                        @else
                                        Khong co
                                        @endif
                                    </td> --}}
                                    <td>
                                        {{--                                           <a style="display: inline-block; width: 67px;" href="{{route('todos.show', $item->id)}}" class="btn btn-warning">Show</a>--}}
                                        <a href="{{ route('backend.product.show', $product->id) }}" class="btn btn-info">Detail</a>
                                        <a style="display: inline-block; width: 67px;" href="{{route('backend.product.edit', $product->id)}}" class="btn btn-success">Edit</a>
                                        <form style="display: inline-block;" action="{{route('backend.product.destroy', $product->id)}}" method="post" accept-charset="utf-8">
                                         @csrf
                                         {{method_field('delete')}}
                                         <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
                                 </td>

                                        {{-- <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->content }}</td> --}}
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {!! $products->links() !!}
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
