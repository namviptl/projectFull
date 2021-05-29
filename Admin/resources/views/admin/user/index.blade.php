@extends('layouts.admin')

@section('title')
  <title>Danh sách nhân viên</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'User', 'key' => 'list'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        @can('acount-edit', User::class)
        <div class="col-md-12">
          <a style="margin-bottom: 10px;" href="{{ route('user.create') }}" class="btn btn-success float-right m2">Thêm mới</a>
        </div>
        @endcan
        <div class="col-md-12"> 
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                  @can('acount-edit', User::class)
                  <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-default">Sửa</a>
                  <a data-url="{{ route('user.delete', ['id' => $user->id]) }}" id="delete-user" class="btn btn-danger">Xóa</a>
                  @endcan
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>

        <div class="col-md-2">
          {{$users->links()}}
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