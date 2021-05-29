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
            @can('discount-add', Discount::class)
            <div class="col-md-12">
              <a style="margin-bottom: 10px;" href="{{ route('discount.create') }}" class="btn btn-success float-right m2">Thêm mới</a>
            </div>
            @endcan
            <div class="col-md-12"> 
              <table class="table ">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center" >STT</th>
                    <th class="text-center" >Mã giảm</th>
                    <th class="text-center" >%</th>
                    <th class="text-center" >Ngày bắt đầu</th>
                    <th class="text-center" >Ngày kết thúc</th>
                    <th class="text-center" >Trạng thái</th>

                    <th class="text-center">Chức năng</th>

                  </tr>
                </thead>
                @php $stt = 0 @endphp
                @foreach ($discounts as $discount)
                @php $stt++ @endphp
                <tbody>
                  <tr>
                    <th scope="row" class="text-center">{{$stt}}</th>
                    <td class="text-center" >{{$discount->code}}</td>
                    <td class="text-center" >{{$discount->discount}}</td>
                    <td class="text-center" >{{date("d/m/Y",strtotime($discount->start_day))}}</td>
                    <td class="text-center" >{{date("d/m/Y",strtotime($discount->end_day))}}</td>
                    <td class="text-center" >@if (time() > strtotime($discount->end_day)){{'Hết hạn'}} @else {{'Còn hạn'}} @endif</td>
                    <td class="text-center">
                       <a href="{{-- {{ route('categories.edit', ['id' => $category->id]) }} --}}" class="btn btn-default">Sửa</a>
                    <a data-url="{{-- {{ route('categories.delete', ['id' => $category->id]) }} --}}" id="delete-category" class="btn btn-danger">Xóa</a>
                    </td>
                   @endforeach
                  </tr>
                </tbody>
              </table>
            </div> 
          </div>
      </div>
    </div>  
</div>
@endsection
@section('js')
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('admins/myJava.js') }}"></script>
@endsection