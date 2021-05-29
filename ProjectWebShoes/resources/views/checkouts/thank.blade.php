@extends('index')
@section('title')<title>Thank You</title>@endsection
@section('css')
@endsection
@section('content')

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <span class="icon-check_circle display-3 text-success"></span>
        <h2 class="display-3 text-black">Cảm ơn!</h2>
        <p class="lead mb-5">Bạn đã đặt hàng thành công vui lòng kiểm tra email để xem đơn hàng.</p>
        <p><a href="{{ route('home') }}" class="btn btn-sm btn-primary">Trang chủ</a></p>
      </div>
    </div>
  </div>
</div>
@endsection