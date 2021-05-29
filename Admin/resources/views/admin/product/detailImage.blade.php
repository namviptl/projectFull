@extends('layouts.admin')

@section('title')
  <title>Danh sách ảnh sản phẩm chi tết</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Image Detail Product', 'key' => 'list'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12"> 
          <table class="table">
            <thead class="thead-dark">
              <tr>Ảnh chi tiết</th>
              </tr>
            </thead>
            <tbody>
               <tr>
                <td>
              @foreach ($products as $product)
             
                  
                   <img style="margin-right: 40px;: " src="{{$product->image_path}}" width="300" height="300">
                  
                
              @endforeach
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <a href="{{ route('product.index') }}" class="btn btn-primary">Quay lại</a>
        <div class="col-md-2">
        {{--   {{ $products->links() }} --}}
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

