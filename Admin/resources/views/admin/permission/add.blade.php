@extends('layouts.admin')

@section('title')
  <title>Thêm mới</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'permission', 'key' => 'add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <form action="{{ route('permissions.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="">Chọn tên module</label>@error('category_id')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                <select class="custom-select" name="module_parent">
                  <option selected value="">Tên module</option>
                  @foreach (config('permissions.table_module') as $key => $moduleItem)
                    <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <div class="row">
                  @foreach (config('permissions.module_childrent') as $key => $moduleChilrentItem)
                  <div class="col-md-3">
                    <label>
                      <input type="checkbox" name="module_chilrent[]" value="{{$moduleChilrentItem}}"> {{$moduleChilrentItem}}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
              <button type="submit" class="btn btn-primary mb-2 btn-add">Thêm mới</button>
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
    $(document).on('click', '.btn-add', function () {
      Swal.fire({
          icon: 'success',
          title: 'Thêm mới thành công',
          showConfirmButton: false,
          timer: 7000
      });
    })
  </script> 
@endsection
