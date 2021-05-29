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
            <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post" enctype="multipart/form-data">
              @csrf
              
              <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" class="form-control" name="name"  value="{{$category->name}}" placeholder="Nhập tên danh mục...">
              </div>
              <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <input type="file" class="form-control-file" name="feature_image_path" id="">

                <div class="col-md-12">
                  <div class="row">
                    <img src="{{$category->feature_image_path}}" alt="">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary mb-2 btn-edit">Cập nhật</button>
            </form> 
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>   
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  $(document).on('click', '.btn-edit', function () {
    Swal.fire({
        icon: 'success',
        title: 'Cập nhật thành công',
        showConfirmButton: false,
        timer: 7000
    });
  })
</script>
@endsection