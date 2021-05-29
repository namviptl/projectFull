@extends('layouts.admin')

@section('title')
  <title>Danh sách hóa đơn</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Order', 'key' => 'list'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12"> 
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th class="text-center">Mã đơn</th>
                <th class="text-center">Chi tiết đơn</th>
                <th class="text-center">Ghi chú</th>
                <th class="text-center">Trừ điểm</th>
                <th class="text-center">Giảm giá</th>
                <th class="text-center">Tổng hóa đơn</th>
                <th class="text-center">Ngày đặt</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <tr>
                <th scope="row"></th>
                <td class="text-center">{{$order->id}}</td>
                <td class="text-center"><a href="{{ route('order.detail', ['id' => $order->id]) }}" class="btn btn-success">Xem</a></td>
                <td width="250">{{$order->notes}}</td>
                <td class="text-center">{{$order->minus_point}}</td>
                <td class="text-center">{{$order->discount}}</td>
                <td class="text-center">{{number_format($order->price_total)}} đ</td>
                <td class="text-center">{{$order->created_at}}</td>
                <td class="text-center">{{$order->status}}</td>

                <td>
                  @can('discount-delete', Order::class)
                  <a data-url="{{ route('order.delete', ['id' => $order->id]) }}" id="delete-order" class="btn btn-danger">Xóa</a>
                  @endcan
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>

        <div class="col-md-2">
          {{$orders->links()}}
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