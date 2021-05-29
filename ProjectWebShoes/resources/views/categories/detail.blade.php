@extends('index')

@section('title')<title>Chi tiết sản phẩm</title>@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/ratting.css') }}">
<style type="text/css">
  .mb-5, .my-5 {
      margin-bottom: 1rem!important;
  }
</style>
@endsection
@section('content')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Chi tiết sản phẩm</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100 img-fluid" src="{{ config('app.base_url').$product->feature_image_path }}" alt="First slide">
                </div>
                @foreach ($productImage as $image)
                
                <div class="carousel-item">
                  <img class="d-block w-100 img-fluid" src="{{ config('app.base_url').$image->image_path }}" alt="Second slide">
                </div>
                @endforeach
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <svg style="color: #000;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                  </svg>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <svg style="color: #000;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                  <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
              </a>
            </div>
          </div>
          <div class="col-md-6">
            {{-- <div class="row">
              <div class="col-md-3">
                <h3 style="color: #000; ">Đánh giá: </h3>
              </div>
              <div class="col-md-9" style="position: relative;top: -3px;left: -40px;">
                <div class="starrating risingstar d-flex justify-content-center flex-row-reverse" style="justify-content: space-evenly !important;">

                  <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
                  <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                  <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                  <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                  <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
                </div>
              </div>
              
            </div> --}}
 

            <h2 class="text-black">{{$product->name}}</h2>
            <p><strong class="text-primary h4">
            @if ($product->discount > 0)
              <span style="text-decoration-line: line-through; color: red !important; margin-right: 10px;">{{number_format($product->price)}} đ </span><span>{{number_format($product->price * (1- 1/$product->discount))}} đ</span>
            @else
              {{number_format($product->price)}} đ
            @endif
            </strong></p>

            

            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center quantity" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

            <div class="mb-1 d-flex">
              <div class="btn-group">
                <button style="background: #7971ea; border: solid #7971ea;" class="btn btn-danger size-up" value="">Size</button>
                <button type="button" style="background: #7971ea; border: solid #7971ea;" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                </button>
                <div class="dropdown-menu" style="min-width: 0px !important;z-index: 999;">
                  <a class="dropdown-item dropdown-size" data-id='36'>36</a>
                  <a class="dropdown-item dropdown-size" data-id='37'>37</a>
                  <a class="dropdown-item dropdown-size" data-id='38'>38</a>
                  <a class="dropdown-item dropdown-size" data-id='39'>39</a>
                  <a class="dropdown-item dropdown-size" data-id='40'>40</a>
                  <a class="dropdown-item dropdown-size" data-id='41'>41</a>
                  <a class="dropdown-item dropdown-size" data-id='42'>42</a>
                  <a class="dropdown-item dropdown-size" data-id='43'>43</a>
                  <a class="dropdown-item dropdown-size" data-id='44'>44</a>
                </div>
              </div>
            </div>


            </div>
            <p><a style="color: #fff;" class="buy-now btn btn-sm btn-primary add-cart" data-id="{{$product->id}}" data-url="{{ route('add-cart', ['id' => $product->id]) }}">Thêm vào giỏ hàng</a>
              <button style="margin-left: 10px" data-url="{{ route('add-to-cart', ['id' => $product->id]) }}" class="buy-now btn btn-sm btn-primary add-to-cart">Mua ngay</button>
            </p>
            <p></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Sản phẩm mới</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
              @foreach ($prod_new as $prod)
                <div class="item">
                <div class="block-4 text-center">
                  <figure class="block-4-image">
                    <img src="{{config('app.base_url') . $prod->feature_image_path}}" alt="Image placeholder" class="img-fluid">
                  </figure>
                  <div class="ps-badge"><span>New</span></div>
                  <div class="block-4-text p-4">
                    <h3><a href="{{ route('categories.detail', ['id' => $prod->id, 'name' => Str::slug($prod->name)]) }}">{{$prod->name}}</a></h3>
                    <p class="text-primary font-weight-bold" >{{number_format($prod->price)}} đ</p>
                  </div>
                </div>
              </div>
              @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/myJava.js') }}"></script>
<script type="text/javascript">
    // $('.dropdown-item').on('click', function(e){
    //   e.preventDefault();
    //   var size = $(this).attr('data-id');
    //   $('.size-up').text(size);
    //   $('.size-up').attr('value', size);
    // });

    $('.add-cart').on('click', function(e){
        e.preventDefault();
        let size = $('.size-up').val();
        let id = $(this).attr('data-id');
        let urlRequest = $(this).data('url');
        let quantity = $('.quantity').val();
        if(quantity < 1){
           Swal.fire({
            icon: 'warning',
            title: 'Số lượng sai!!!',
            showConfirmButton: false,
            timer: 2000
          })
         }else if(size == '' || size < 36 || size > 44){
            Swal.fire({
              icon: 'warning',
              title: 'Size không đúng!!!',
              showConfirmButton: false,
              timer: 2000
            })
         }else if(quantity > 10){
            Swal.fire({
              icon: 'warning',
              title: 'Số lượng lớn yêu cầu liên hệ shop!!!',
              showConfirmButton: false,
              timer: 2000
            })
         }else{
            Swal.fire({
              icon: 'success',
              title: 'Thêm vào giỏ hàng thành công',
              showConfirmButton: false,
              timer: 1500
            })
            $.ajax({
              type: 'GET',
              url: urlRequest,
              data : {
                size : size,
                quantity : quantity,
              },

              success: function(data){
                if(data.code == 200){
                  $("#load-cart").load(" .site-cart");
                  
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
    });
    $('.add-to-cart').on('click', function(e){
        e.preventDefault();
        let size = $('.size-up').val();
        let id = $(this).attr('data-id');
        let urlRequest = $(this).data('url');
        let quantity = $('.quantity').val();
        if(quantity < 1){
           Swal.fire({
            icon: 'warning',
            title: 'Số lượng sai!!!',
            showConfirmButton: false,
            timer: 2000
          })
         }else if(size == '' || size < 36 || size > 44){
            Swal.fire({
              icon: 'warning',
              title: 'Size không đúng!!!',
              showConfirmButton: false,
              timer: 2000
            })
         }else if(quantity > 10){
            Swal.fire({
              icon: 'warning',
              title: 'Số lượng lớn yêu cầu liên hệ shop!!!',
              showConfirmButton: false,
              timer: 2000
            })
         }else{
            Swal.fire({
              icon: 'success',
              title: 'Thêm vào giỏ hàng thành công',
              showConfirmButton: false,
              timer: 1500
            })
            $.ajax({
              type: 'GET',
              url: urlRequest,
              data : {
                size : size,
                quantity : quantity,
              },

              success: function(data){
                if(data.code == 200){
                  // $("#load-cart").load(" .site-cart");
                  $(location).attr('href', "{{ route('cart') }}");
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
    });
</script>
@endsection
