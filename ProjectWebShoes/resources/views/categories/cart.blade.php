@extends('index')

@section('title')<title>Chi tiết sản phẩm</title>@endsection
@section('css')
@endsection
@section('content')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Giỏ hàng</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="site-blocks-table">
              <div id="load-table-cart">
                <div id="table-cart">
                @if ($cart == null)
                  {{Session::forget('discount')}}
                  <div class="col-md-12 text-center"><h2>Bạn không có sản phẩm nào trong giỏ hàng!!!</h2></div>
                @else
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="product-thumbnail">Ảnh</th>
                      <th class="product-name">Tên sản phẩm</th>
                      <th class="product-name">Size</th>
                      <th class="product-price">Giá</th>
                      <th class="product-quantity">Số lượng</th>
                      <th class="product-total">Tổng tiền</th>
                      <th class="product-remove">Xóa</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                      $total = 0;
                      $sumTotal = 0;
                    @endphp
                    @foreach ($cart as $size)
                      @foreach ($size as $value)
                      @php 

                        if($value['discount'] > 0){
                          $sumTotal += ($value['price'] * (1-1/$value['discount'])) * ($value['quantity_order']);
                        }else{
                          $sumTotal += $value['price'] * $value['quantity_order'];
                        }
                        
                        Session::put('sumTotal', $sumTotal);
                        
                      @endphp
                      <tr>
                        <td class="product-thumbnail">
                          <img src="{{config('app.base_url').$value['feature_image_path']}}" width="160" height="110" alt="Image" class="img-fluid">
                        </td>
                        <td class="product-name" style="width: 290px;">
                          <h2 class="h5 text-black">{{$value['name']}}</h2>
                        </td>
                        <td style="width: 0px;">
                          <div class="mb-1 d-flex">
                            <div class="btn-group">
                              <div style="color:#fff;background: #7971ea;border: 8px solid #7971ea;border-radius: 4px;width: 50px;position: relative;left: 11px;">{{$value['size']}}</div>
                            </div>
                          </div>
                        
                        </td>
                        <td>
                        @if ($value['discount'] > 0)
                         {{number_format($value['price'] * (1- 1/$value['discount']))}} đ
                        @else
                         {{number_format($value['price'])}} đ
                        @endif
                         
                       

                        </td>
                        <td style="max-width: 0">
                          <div class="input-group mb-3" style="max-width: 110px;margin-bottom: 0 !important;">
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-primary js-btn-minus minus" data-url="{{ route('update-cart') }}" onclick="minusQty({{$value['id'].','.$value['size']}})" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center quantity" id="{{$value['id'].'-'.$value['size']}}" value="{{$value['quantity_order']}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                              <button class="btn btn-outline-primary js-btn-plus plus" data-url="{{ route('update-cart') }}" onclick="plusQty({{$value['id'].','.$value['size']}})" type="button">&plus;</button>
                            </div>
                          </div>

                        </td>
                        <td>
                          @if ($value['discount'] > 0)
                            @php $total = ($value['price'] * (1-1/$value['discount'])) * ($value['quantity_order']) @endphp {{number_format($total)}} đ
                          @else
                            @php $total = $value['price'] * $value['quantity_order'] @endphp {{number_format($total)}} đ
                          @endif
                          

                        </td>
                        <td><a style="color: #fff;" data-url="{{ route('delete-cart') }}" id="del-{{$value['id'].'-'.$value['size']}}" onclick="delCart({{$value['id'].','.$value['size']}})" class="btn btn-primary btn-sm btn-del">X</a></td>
                      </tr>
                      @endforeach
                     @endforeach

                  </tbody>
                </table>
                @endif
                </div>
              </div>
               
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6">
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm btn-block">Trang chủ</a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Giảm giá</label>
                <p>Hãy nhập mã giảm giá nếu có.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="discount" value="@if (Session::has('discount')){{"GIAM".Session::get('discount')}}@endif" placeholder="Mã giảm giá">
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm btn-discount" onclick="discount()" data-url='{{ route('discount') }}'>Áp dụng</button>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Tổng thanh toán</h3>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Tổng</span>
                  </div>

                  <div class="col-md-6 text-right" id="load-total">
                    @if ($cart == null)
                      {{Session::forget('sumTotal')}}
                    @endif
                    <strong class="text-black" id="total">
                      @if (Session::has('discount') && Session::has('sumTotal'))
                        @php $total = Session::get('sumTotal') * (1-(Session::get('discount')/100)); 
                              Session::put('sumTotal', $total);
                        @endphp
                        {{number_format(Session::get('sumTotal'))}} đ
                      @else
                        @if (Session::has('sumTotal'))
                          {{number_format(Session::get('sumTotal'))}} đ
                        @else
                          {{0}} đ
                        @endif
                      @endif

                    </strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='{{ route('checkouts.checkout') }}'">Mua hàng</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

function discount(){
  let urlRequest = $('.btn-discount').data('url');
  let discount = $('#discount').val();
  $.ajax({
    type: 'GET',
    url: urlRequest,
    data : {
      discount : discount
    },

    success: function(data){
      $("#load-total").load(" #total");
      if(data.code == 200){
        // $("#load-table-cart").load(" #table-cart");
        // $("#load-cart").load(" .site-cart");
        $("#load-total").load(" #total");
        Swal.fire({
          icon: 'success',
          title: 'Áp dụng thành công',
          showConfirmButton: false,
          timer: 1500
        })
      } 
    },
    error: function(){
      Swal.fire({
          icon: 'warning',
          title: 'Mã không tồn tại',
          showConfirmButton: false,
          timer: 2000
      })
    }
  });
}
    function delCart(id, size){
      let urlRequest = $('.btn-del').data('url');

      Swal.fire({
        title: 'Bạn muốn xóa sản phẩm này chứ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7971ea',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Không'
      }).then((result) => {
        
        if (result.isConfirmed) {
          Swal.fire(
            'Đã xóa',
            'Sản phẩm của bạn đã xóa!',
            'success',
          )
          $.ajax({
            type: 'GET',
            url: urlRequest,
            data : {
              id : id,
              size : size,
            },

              success: function(data){
                if(data.code == 200){
                  $("#load-table-cart").load(" #table-cart");
                  $("#load-cart").load(" .site-cart");
                  $("#load-total").load(" #total");
                }
              },
              error: function(){
                Swal.fire(
                    'Thất bại!',
                    'warning'
                )
              }
          });

        }
      })
    }

    function minusQty(id, size) {
      let quantity = parseInt($('#' + id + '-' + size).val());
      quantity -= 1;
      let urlRequest = $('.minus').data('url');
      if(quantity < 1){
        
        Swal.fire({
          title: 'Bạn muốn xóa sản phẩm này chứ?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#7971ea',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Xóa',
          cancelButtonText: 'Không'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Đã xóa',
              'Sản phẩm của bạn đã xóa!',
              'success',
            )
            $.ajax({
              type: 'GET',
              url: urlRequest,
              data : {
                id : id,
                size : size,
                quantity : quantity,
              },

              success: function(data){
                if(data.code == 200){
                  $("#load-table-cart").load(" #table-cart");
                  $("#load-cart").load(" .site-cart");
                  $("#load-total").load(" #total");
                }
              },
              error: function(){
                // Swal.fire(
                //     'Thất bại!',
                //     'warning'
                // )
              }
            });
          }
        })
      }else{
        Swal.fire({
          icon: 'success',
          title: 'Cập nhật giỏ hàng thành công',
          showConfirmButton: false,
          timer: 2000
        })
        $.ajax({
          type: 'GET',
          url: urlRequest,
          data : {
            id : id,
            size : size,
            quantity : quantity,
          },

          success: function(data){
            if(data.code == 200){
              $("#load-table-cart").load(" #table-cart");
              $("#load-cart").load(" .site-cart");
              $("#load-total").load(" #total");
            }
          },
          error: function(){
            // Swal.fire(
            //     'Thất bại!',
            //     'warning'
            // )
          }
        });
      }   
    }

    function plusQty(id, size) {
      let quantity = parseInt($('#' + id + '-' + size).val());
      quantity += 1;
      let urlRequest = $('.plus').data('url');
      Swal.fire({
        icon: 'success',
        title: 'Cập nhật hàng thành công',
        showConfirmButton: false,
        timer: 1500
      })
      $.ajax({
        type: 'GET',
        url: urlRequest,
        data : {
          id : id,
          size : size,
          quantity : quantity,
        },

        success: function(data){
          if(data.code == 200){
            $("#load-table-cart").load(" #table-cart");
            $("#load-cart").load(" .site-cart");
            $("#load-total").load(" #total");
          }
        },
        error: function(){
          // Swal.fire(
          //     'Thất bại!',
          //     'warning'
          // )
        }
      });
    }   
    
</script>
@endsection