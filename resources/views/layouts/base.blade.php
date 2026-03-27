<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Trips')</title>
    <link rel="icon" type="image/png" href="{{ asset('oldal/images/ikon.png') }}">
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
    <style>
        .dropdown-menu {
            display: none;
            position: absolute;
            background: white;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000;
            border-radius: 4px;
            padding: 8px 0;
            top: 100%;
            left: 0;
            border: 1px solid #dee2e6;
        }
        
        .site-menu li {
            position: relative;
        }
        
        .site-menu li:hover .dropdown-menu {
            display: block;
        }
        
        .dropdown-item {
            display: block;
            padding: 8px 16px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            white-space: nowrap;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
            text-decoration: none;
        }
        
        .nav-link {
            position: relative;
            display: block;
            padding: 0.5rem 1rem;
            color: #fff;
        }
        
        .nav-link:hover {
            color: #fff;
            text-decoration: none;
        }
        
        .nav-link:hover .dropdown-menu {
            display: block;
        }
        
        /* Ensure dropdown stays above other content */
        .site-navigation {
            position: relative;
            z-index: 100;
        }
    </style>
    @stack('styles')
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <header class="site-navbar site-navbar-target" role="banner">
        <div class="container">
          <div class="row align-items-center position-relative">
            <div class="col-3 ">
              <div class="site-logo">
                <a href="{{ url('/') }}" class="font-weight-bold">
                  <img src="{{ asset('oldal/images/logo.png') }}" class="img-fluid">
                </a>
              </div>
            </div>
            <div class="col-9  text-right">
              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>
              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}" class="nav-link">Kezdőlap</a></li>
                  <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}" class="nav-link">Rólunk</a></li>
                  <li class="{{ request()->is('trips') ? 'active' : '' }}"><a href="{{ url('/trips') }}" class="nav-link">Utazások</a></li>
                  <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" class="nav-link">Kapcsolat</a></li>
                  <li class="{{ request()->is('quiz*') ? 'active' : '' }}"><a href="{{ url('/quiz') }}" class="nav-link">Teszt</a></li>
                  @auth
                  @if(auth()->user()->is_admin)
                  <li class="{{ request()->is('admin*') ? 'active' : '' }}"><a href="{{ url('/admin') }}" class="nav-link">Admin</a></li>
                  @endif
                  <li class="{{ request()->is('profil') ? 'active' : '' }}"><a href="{{ route('profile') }}" class="nav-link">Profil</a></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                      @csrf
                      <button type="submit" class="nav-link p-0" style="display:inline; background:none; border:0; padding:0; font: inherit; color: inherit; cursor:pointer;">Kijelentkezés</button>
                    </form>
                  </li>
                  @else
                  <li><a href="{{ url('/bejelentkezes') }}" class="nav-link">Bejelentkezés</a></li>
                  <li><a href="{{ url('/regisztracio') }}" class="nav-link">Regisztráció</a></li>
                  @endauth
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </header>

      @yield('body')

      @hasSection('footer')
        @yield('footer')
      @else
        @include('partials.footer')
      @endif

    </div>

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


