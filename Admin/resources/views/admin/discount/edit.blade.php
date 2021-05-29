@extends('layouts.admin')

@section('title')
  <title>Thêm mới</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'category', 'key' => 'edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
              @csrf
              
              <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" class="form-control" name="name"  value="{{$category->name}}" placeholder="Nhập tên danh mục...">
              </div>
              <button type="submit" class="btn btn-primary mb-2">Cập nhật</button>
            </form> 
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>   
@endsection
