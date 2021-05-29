@extends('layouts.admin')

@section('title')
  <title>Danh sách hóa đơn</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Order', 'key' => 'detail'])
    <div class="content">
      <div class="container-fluid">
		<div class="page-title">
			<div class="row">

				<div class="col-md-6">
				    <h4>Thông tin khách hàng:</h4>
				    <p><strong>Họ và tên: </strong>{{$user->user->name}}</p>
				    <p><strong>Số điện thoại: </strong>{{$user->user->phone}}</p>
				    <p><strong>Email: </strong>{{$user->user->email}}</p>
				    <p><strong>Địa chỉ: </strong>{{$user->user->address}}</p>
				</div>
				<div class="col-md-6">
					<h4>Thông tin đơn hàng</h4>
					
				    <p><strong> Trừ điểm: </strong>{{$oneDetail->order->minus_point}}</p>
				    <p><strong> Giảm giá theo mã: </strong>{{$oneDetail->order->discount}} %</p>
				    <p><strong> Tổng tiền trước giảm: </strong>
				    	@php $total = 0 @endphp
					    @foreach ($detail as $val)
							@php $total += $val->price * $val->quantity;  @endphp
						@endforeach
						{{number_format($total)}} đ
				 	</p>
				    <p><strong> Tổng đơn hàng: </strong> {{number_format($oneDetail->order->price_total)}} đ</p>
				</div>
			</div>
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th class="text-center" style="width: 100px;">Mã đơn hàng</th>
						<th class="text-center">Sản phẩm</th>
						<th class="text-center">Size</th>
						<th class="text-center">Số lượng</th>
						<th class="text-center">Giá gốc </th>
						<th class="text-center">Giảm giá (%)</th>
						<th class="text-center">Giá giảm</th>
						<th class="text-center">Tổng tiền</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($detail as $dt)

				    <tr>
				      <th class="text-center">{{$dt->order_id}}</th>
				      <td class="text-center">{{($dt->product)->name}}</td>
				      <td class="text-center">{{$dt->size}}</td>
				      <td class="text-center">{{$dt->quantity}}</td>
				      <td class="text-center">{{number_format(($dt->product)->price)}} đ</td>
				      <td class="text-center">{{($dt->product)->discount}}</td>
				      <td class="text-center">
				      	@if ( ($dt->product)->discount > 0 )
				      		{{number_format($dt->price * (1-1/($dt->product)->discount) )}}
				      	@else
				      		{{number_format($dt->price)}}
				      	@endif
				      		
				      </td>{{-- tính --}}
				      <td class="text-center">{{number_format($dt->price_total)}} đ</td>
				    </tr>

				@endforeach	
				
				    <tr>
				    	<th class="text-center">Chức năng</th>
				    	<form method="POST">
					    	<td class="text-center" colspan="1"><button type="submit" name="sm_cancel" class="btn btn-dark">Hủy đơn hàng</button></td>
					    	<td class="text-center" colspan="3"><button type="submit" name="sm_move" class="btn btn-dark">Đang giao</button></td>
					    	<td class="text-center" colspan="3"><button type="submit" name="sm_finish" class="btn btn-dark">Hoàn thành</button></td>
				    	</form>
				    </tr>
				</tbody>
			</table>
			<div>
				<h3><a href="" class="btn btn-primary">Quay lại</a></h3>
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