@extends('layouts.admin')

@section('title')
  <title>Danh sách sản phẩm</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Product', 'key' => 'list'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        @can('product-add', Product::class)
        <div class="col-md-12">
          <a style="margin-bottom: 10px;" href="{{ route('product.create') }}" class="btn btn-success float-right m2">Thêm mới</a>
        </div>
        @endcan
        <div class="col-md-12"> 
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Giảm giá (%)</th>
                <th>Trạng thái</th>
                <th>Danh mục</th>
                <th>Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
             
                <tr>
                <th>{{$product->id}}</th>
                <td>
                  <a href="{{ route('product.detailImage', ['id' => $product->id]) }}" ><img alt="click để xem ảnh chi tiết" src="{{$product->feature_image_path}}" width="30" height="30"></a>
                </td>
                <td>{{$product->name}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{number_format($product->price)}} đ</td>
                <td>{{$product->discount}}</td>
                <td>{{$product->status}}</td>
                <td>{{optional($product->category)->name}}</td>
                <td>
                  @can('product-edit', Product::class)
                  <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-default">Sửa</a>
                  @endcan
                  @can('product-delete', Product::class)
                  <a data-url="{{ route('product.delete', ['id' => $product->id]) }}" id="delete-product" class="btn btn-danger">Xóa</a>
                  @endcan
                </td>
                </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>

        <div class="col-md-2">
          {{ $products->links() }}
        </div>  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>   
@endsection
@section('js')
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('admins/myJava.js') }}"></script>
@endsection

