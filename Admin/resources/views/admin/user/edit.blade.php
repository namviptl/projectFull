@extends('layouts.admin')

@section('title')
  <title>Cập nhật tài khoản</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'user', 'key' => 'edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post">
              @csrf
              
              <div class="form-group">
                <label for="">Tên</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Nhập tên...">
              </div>
               <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" value="{{$user->email}}"  placeholder="Nhập email...">
              </div>
               <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" name="password" value="{{$user->password}}"  placeholder="Nhập mật khẩu...">
              </div>
              <div class="form-group">
                <label for="">Chọn quyền</label>{{-- @error('category_id')<span style="color: red;"> - {{$message}} (*)</span>@enderror --}}
                <select class="custom-select" name="role_id[]" multiple>
                  {{-- <option selected value="">Chọn quyền</option> --}}
                  @foreach ($roles as $role)
                    <option {{$rolesOfUser->contains('id', $role->id) ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                </select>
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