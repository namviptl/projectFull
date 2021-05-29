@php $qty = 0 @endphp
@if (Session::has('cart'))
  @foreach (Session::get('cart') as $size)
    @foreach ($size as $value)
      @php $qty += $value['quantity_order'] @endphp
    @endforeach
  @endforeach
@endif

<header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Search">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="/" class="js-logo-clone">NTN Store</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  @if ($user == null)
                    <li><a href="{{ route('login') }}"><span class="icon icon-person"></span></a></li>
                  @else
                  <li>
                    <div class="btn-group" style="position: relative;bottom: 5px;right: 5px;">
                      <button style="cursor: auto;background: #7971ea; border: solid #7971ea;" class="btn btn-danger" value=""><span class="icon icon-person"></button>
                      <button type="button" style="background: #7971ea; border: solid #7971ea;" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      </button>
                      <div class="dropdown-menu" style="min-width: 0px !important;z-index: 999;">
                        <a class="dropdown-item dropdown-size" href="">{{$user->name}}</a>
                        <a class="dropdown-item dropdown-size" href="{{ route('logout') }}">Logout</a>
                      </div>
                  </li>
                  @endif
                  
                  <li>
                    <div id="load-cart">
                    <a href="{{ route('cart') }}" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>

                      <span class="count">{{$qty}}</span>

                    </a>
                    </div>
                  </li> 
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div> 
            </div>

          </div>
        </div>
      </div> 

       


      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class="has-children  @if ($slug == ''){{'active'}}@endif"> 
              <a href="/">Trang chủ</a>
            </li>
            <li class="has-children @if ($slug == 'shop-all'){{'active'}}@endif">
              <a  href="/shop-all">Tất cả sản phẩm</a>
            </li>
            @foreach ($cates as $cate)

            <li class="has-children  @if ($slug == $cate->slug){{'active'}}@endif"><a href="{{ route('categories.category', ['slug' => $cate->slug]) }}">{{$cate->name}}</a></li>
            @endforeach
            <li><a href="#">Liên hệ</a></li>
          </ul>
        </div>
      </nav>
    </header>