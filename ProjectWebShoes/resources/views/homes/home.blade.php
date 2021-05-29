@extends('index')

@section('title')<title>Trang chủ</title>@endsection
<style>
  .ps-badge{
    font-size: 20px;
  }

</style>
@section('content')
<div class="site-blocks-cover" style="background-image: url(images/hero_1.jpg);" data-aos="fade">
      {{-- <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
          <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
            <h1 class="mb-2">Finding Your Perfect Shoes</h1>
            <div class="intro-text text-center text-md-left">
              <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla. </p>
              <p>
                <a href="#" class="btn btn-sm btn-primary">Shop Now</a>
              </p>
            </div>
          </div>
        </div>
      </div> --}}
    </div>


    <div class="site-section site-blocks-2">
      <div class="container">
        <div class="row">
          @foreach ($cates as $cate)
          <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
            <a class="block-2-item" href="{{ route('categories.category', ['slug' => $cate->slug]) }}">
              <figure class="image">
                <img style="height: 500px;" src="{{config('app.base_url').$cate->feature_image_path}}" width="350" height="500" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <h3>{{$cate->name}}</h3>
              </div>
            </a>
          </div>
           @endforeach
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


    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-5">
            <a href="#"><img src="images/blog_1.jpg" alt="Image placeholder" class="img-fluid rounded"></a>
          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2>Giảm ngay 50% nhân ngày khai trương NTN Store</h2>
            <p class="post-meta mb-4">Duy nhất ngày <span class="block-8-sep">&bullet;</span> 29-5-2021</p>
            <p>Nhập ngay mã GIAM50 nhé!</p>
            <p><a href="{{ route('categories.category', ['slug' => 'shop-all']) }}" class="btn btn-primary btn-sm">Mua ngay</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Sản phẩm giảm giá</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
               @foreach ($prod_sale as $prod)
                <div class="item">
                <div class="block-4 text-center">
                  <figure class="block-4-image">
                    <img src="{{config('app.base_url') . $prod->feature_image_path}}" alt="Image placeholder" class="img-fluid">
                  </figure>
                  <div class="ps-badge"><span>Sale - {{$prod->discount}} %</span></div>
                  <div class="block-4-text p-4">
                    <h3><a href="{{ route('categories.detail', ['id' => $prod->id, 'name' => Str::slug($prod->name)]) }}">{{$prod->name}}</a></h3>
                    <p class="text-primary font-weight-bold" ><span style="text-decoration-line: line-through; color: red !important; margin-right: 10px;">{{number_format($prod->price)}} đ </span><span>{{number_format($prod->price * (1- 1/$prod->discount))}} đ</span></p>

                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection