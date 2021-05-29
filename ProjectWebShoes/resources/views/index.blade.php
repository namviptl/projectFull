<!DOCTYPE html>
<html lang="en">
  <head>
    @yield('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="{{ URL::asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/owl.theme.default.min.css') }}">
    

    <link rel="stylesheet" href="{{ URL::asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    @yield('css')
  </head>
  <body>
  
  <div class="site-wrap">
   {{-- header --}}
   @include('layouts.header')
   {{-- endheader --}}
    
    {{-- main --}}
    @yield('content')
    {{-- endmain --}}
    
    {{-- footer --}}
    @include('layouts.footer')
    {{-- endfooter --}}

  </div>

  <script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ URL::asset('js/jquery-ui.js') }}"></script>
  <script src="{{ URL::asset('js/popper.min.js') }}"></script>
  <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ URL::asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ URL::asset('js/aos.js') }}"></script>

  <script src="{{ URL::asset('js/main.js') }}"></script>
  @yield('js')  
  </body>
</html>