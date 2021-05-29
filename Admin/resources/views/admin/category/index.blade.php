@extends('layouts.admin')

@section('title')
  <title>Danh sách danh mục</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Category', 'key' => 'list'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        @can('category-add', Category::class)
        <div class="col-md-12">
          <a style="margin-bottom: 10px;" href="{{ route('categories.create') }}" class="btn btn-success float-right m2">Thêm mới</a>
        </div>
        @endcan
        <div class="col-md-12"> 
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Hình ảnh</th>
                <th>Tên danh mục</th>
                <th>Chức năng</th>
              </tr>
            </thead>
            <tbody>
                
            
              @foreach ($categories as $category)
                <tr>
                <th scope="row">{{$category->id}}</th>
                <td>
                  <img src="{{$category->feature_image_path}}" width="30" height="30">
                </td>
                <td>{{$category->name}}</td>
                <td>
                 @can('category-edit', Category::class)<a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-default">Sửa</a>@endcan
                  @can('category-delete', Category::class)<a data-url="{{ route('categories.delete', ['id' => $category->id]) }}" id="delete-category" class="btn btn-danger">Xóa</a>@endcan
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>

        <div class="col-md-2">
          
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