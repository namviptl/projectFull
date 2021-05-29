@extends('index')
@section('title')<title>Trang chủ</title>@endsection
@section('content')
<div class="bg-light py-3">
<div class="container">
  <div class="row">
    <div class="col-md-12 mb-0"><a href="index.html">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$slug}}</strong></div>
  </div>
</div>
</div>

<div class="site-section">
<div class="container">

  <div class="row mb-5">
    <div class="col-md-9 order-2">

      <div class="row">
        <div class="col-md-12 mb-5">
          <div class="float-md-left mb-4"><h2 class="text-black h5">
            @if ($slug == 'shop-all')
              <span style="text-transform: uppercase;">{{'Tất cả sản phẩm'}}</span>
              @else
                <span style="text-transform: uppercase;">{{$slug}}</span>
            @endif
          </h2></div>
          <div class="d-flex">
            <div class="dropdown mr-1 ml-md-auto">
              <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                @foreach ($cates as $cate)
                 <a class="dropdown-item" href="{{$cate->slug}}">{{$cate->name}}</a>
                @endforeach
                
              </div>
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Sắp xếp</button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                <a class="dropdown-item" href='{{ route('price-asc', ['slug' => $slug]) }}'>Giá tăng dần</a>
                <a class="dropdown-item" href='{{ route('price-desc', ['slug' => $slug]) }}'>Giá tăng dần</a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-5">

        @foreach ($products as $product)
        <div class="col-sm-6 col-lg-4 mb-4"  data-aos="fade-up">
          <div class="block-4 text-center border" >
            <figure class="block-4-image" >
              <a href="{{ route('categories.detail', ['id' => $product->id, 'name' => Str::slug($product->name)]) }}"><img src="{{config('app.base_url').$product->feature_image_path}}" alt="Image placeholder" class="img-fluid"></a>
            </figure>
            <div class="block-4-text p-4">
              @if ($product->discount > 0)
              <div class="ps-badge"><span>Sale - {{$product->discount}} %</span></div>
              @else
                <div class="ps-badge"><span> &ensp;</span></div>
              @endif
              <h3><a href="{{ route('categories.detail', ['id' => $product->id, 'name' => Str::slug($product->name)]) }}">{{$product->name}}</a></h3>
              <p class="text-primary font-weight-bold"> @if ($product->discount > 0)
              <span style="text-decoration-line: line-through; color: red !important; margin-right: 10px;">{{number_format($product->price)}} đ </span><span>{{number_format($product->price * (1- 1/$product->discount))}} đ</span>
            @else
              {{number_format($product->price)}} đ
            @endif</p>
            </div>
          </div>
        </div>
        @endforeach

      </div>
      <div class="row" data-aos="fade-up">
        <div style="margin-left: 300px;" class="col-md-12 text-center">
          <div class="site-block-27">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3 order-1 mb-5 mb-md-0">
      <div class="border p-4 rounded mb-4">
        <h3 class="mb-3 h6 text-uppercase text-black d-block">Danh mục</h3>
        <ul class="list-unstyled mb-0">
          @foreach ($cates as $cate)
          <li class="mb-1"><a href="{{ route('categories.category', ['slug' => $cate->slug]) }}" class="d-flex"><span>{{$cate->name}}</span> <span class="text-black ml-auto">{{count($cate->products)}}</span></a></li>
          @endforeach
        </ul>
      </div>

    </div>
  </div>


  
</div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/myJava.js') }}"></script>
@endsection
    