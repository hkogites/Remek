<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Trips')</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('oldal/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('oldal/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('oldal/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('oldal/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('oldal/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('oldal/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('oldal/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('oldal/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('oldal/css/style.css') }}">
    @stack('styles')
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    @yield('body')
    <script src="{{ asset('oldal/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('oldal/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('oldal/js/popper.min.js') }}"></script>
    <script src="{{ asset('oldal/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('oldal/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('oldal/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('oldal/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('oldal/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('oldal/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('oldal/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('oldal/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('oldal/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('oldal/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('oldal/js/aos.js') }}"></script>
    <script src="{{ asset('oldal/js/main.js') }}"></script>
    @stack('scripts')
  </body>
</html>


