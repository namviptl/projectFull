@extends('index')
@section('title')<title>Chi tiết hóa đơn</title>@endsection
@section('css')
@endsection
@section('content')
<div class="bg-light py-3">
    
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Giỏ hàng</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Chi tiết hóa đơn</strong></div>
        </div>
      </div>
    </div>
    

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          @if ($user == null)
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              Bạn đã có tài khoản? <a href="{{ route('login') }}">Click here</a> Đăng nhập
            </div>
          </div>
          @endif
        </div>
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0"> 
            <h2 class="h3 mb-3 text-black">Chi tiết hóa đơn</h2>
            <div class="p-3 p-lg-5 border">
            <form action="{{ route('post.checkout') }}" method="POST" class="form-sm">
            @csrf
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="name" class="text-black">Họ và tên <span class="text-danger">*</span></label>@error('name')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                  <input type="text" class="form-control"  @if ($user != null) value="{{$user->name}}" readonly @else value="{{old('name')}}" @endif id="name" name="name" placeholder="Nhập họ và tên...">
                </div>
              </div>

              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="email" class="text-black">Email <span class="text-danger">*</span></label>@error('email')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                  <input type="email" class="form-control"  id="email" name="email" placeholder="email..." @if ($user != null) value="{{$user->email}}" readonly @else value="{{old('email')}}" @endif>
                </div>
                <div class="col-md-6">
                  <label for="phone" class="text-black">Số điện thoại <span class="text-danger">*</span></label>@error('phone')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại..." @if ($user != null) value="{{$user->phone}}" readonly @else value="{{old('phone')}}" @endif>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="address" class="text-black">Địa chỉ <span class="text-danger">*</span></label>@error('address')<span style="color: red;"> - {{$message}} (*)</span>@enderror
                  <input type="text" class="form-control" id="address" name="address" placeholder="Điền thông tin địa chỉ..." @if ($user != null) value="{{$user->address}}" readonly @else value="{{old('address')}}" @endif>
                </div>
              </div>
              
              <div class="form-group">
                <label for="notes" class="text-black">Ghi chú</label>
                <textarea name="notes" id="notes" cols="30" rows="5" class="form-control" placeholder="Ghi chú của bản..."></textarea>
              </div>

            </div>
          </div>
          <div class="col-md-6">

    
            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Hóa đơn</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Sản phẩm</th>
                      <th>size</th>
                      <th>Tổng tiền</th>
                    </thead>
                    <tbody>
                      @php $totalPrev = 0; @endphp
                      @foreach ($cart as $size)
                      	@foreach ($size as $val)
                          @php 
                            if($val['discount'] > 0){
                              $totalPrev += ($val['price'] * (1-1/$val['discount'])) * ($val['quantity_order']);
                            }else{
                              $totalPrev += $val['price'] * $val['quantity_order'];
                            }

                          @endphp
                      		<tr>
		                        <td style="max-width: 100px;">{{$val['name']}}<strong class="mx-2">x</strong> {{$val['quantity_order']}}</td>
		                        <td>{{$val['size']}}</td>
		                        <td> 
                              @if ($val['discount'] > 0)
                                @php $total = ($val['price'] * (1-1/$val['discount'])) * ($val['quantity_order']) @endphp {{number_format($total)}} đ
                              @else
                                @php $total = $val['price'] * $val['quantity_order'] @endphp {{number_format($total)}} đ
                              @endif
                        </td>
		                    </tr>
                      	@endforeach
                      @endforeach
                      
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Giá trước giảm</strong></td>
                        <td colspan="2" class="text-black font-weight-bold"><strong>{{number_format($totalPrev)}} đ</strong></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Giảm giá</strong></td>
                        <td colspan="2" class="text-black font-weight-bold"><strong>@if (Session::has('discount'))
                          {{Session::get('discount')}}
                        @else
                          0
                        @endif %</strong></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Tổng thanh toán</strong></td>
                        <td colspan="2" class="text-black font-weight-bold"><strong>{{number_format(Session::get('sumTotal'))}} đ</strong></td>
                      </tr>
                    </tbody>
                  </table>

                 
                  <div class="form-group">
                    <button class="btn btn-primary btn-lg py-3 btn-block" type="submit" id="sm-tt">Thanh toán</button>
                  </div>
                </form>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script type="text/javascript">
  $('#sm-tt').on('click', function () {
      Swal.fire({
        icon: 'success',
        title: 'Đặt hàng thành công mời bạn check mail!',
        showConfirmButton: false,
        timer: 7000
      });
      $(this).hide();
      
  });
</script> --}}
@endsection