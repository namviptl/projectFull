@extends('layouts.admin')

@section('title')
  <title>Danh sách chức năng</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Role', 'key' => 'list'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        @can('role-edit', Role::class)
        <div class="col-md-12">
          <a style="margin-bottom: 10px;" href="{{ route('roles.create') }}" class="btn btn-success float-right m2">Thêm mới</a>
        </div>
        @endcan
        <div class="col-md-12"> 
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Tên chức năng</th>
                <th>Mô tả chức năng</th>
                <th>Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($roles as $role)
                <tr>
                <th scope="row">{{$role->id}}</th>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>
                   @can('role-edit', Role::class)
                  <a href="{{ route('roles.edit', ['id' => $role->id]) }}" class="btn btn-default">Sửa</a>
                    <a data-url="{{ route('roles.delete', ['id' => $role->id]) }}" id="delete-role" class="btn btn-danger">Xóa</a>
                    @endcan
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
