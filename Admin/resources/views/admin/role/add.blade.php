@extends('layouts.admin')

@section('title')
  <title>Thêm mới chức năng</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'role', 'key' => 'add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <form action="{{ route('roles.store') }}" method="post" style="width: 100%;">
            <div class="col-md-6">
                @csrf 
                <div class="form-group">
                  <label for="">Tên chức năng</label>@error('name')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                  <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="Nhập tên vai trò...">
                </div>
                <div class="form-group">
                  <label for="">Mô tả chức năng</label>@error('display_name')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                  <textarea class="form-control" name="display_name" rows="3">{{old('display_name')}}</textarea>
                </div> 
            </div>
            <div class="col-md-12">
              <input type="checkbox" class='check-all' name="">
              Chọn tất
            </div>
            <div class="col-md-12">

              @foreach ($permissions as $permission)
              <div class="card border-secondary mb-3 md-12">
                <div class="card-header" style="background: #000;color: #fff;">
                  <label>
                      <input type="checkbox"  value="{{$permission->id}}" class="checkbox-wrapper">
                  </label>
                  Module {{$permission->name}}@error('permission_id')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                </div>
                <div class="row">
                @foreach ($permission->rolesChildrent as $permissionChildrentItem)
                <div class="card-body text-secondary">
                  <label>
                      <input type="checkbox" name="permission_id[]" value=" {{$permissionChildrentItem->id}}" class="checkbox-childrent">
                  </label>
                  {{$permissionChildrentItem->name}}
                    
                </div> 
                @endforeach
                </div>
              </div>
              @endforeach
 
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary mb-2 btn-add">Thêm mới</button>
            </div>
          </form> 
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>   
@endsection
@section('js')
  <script src="{{ asset('admins/myJava.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    $(document).on('click', '.btn-edit', function () {
      Swal.fire({
          icon: 'success',
          title: 'thêm mới thành công',
          showConfirmButton: false,
          timer: 7000
      });
    })
  </script> 

@endsection