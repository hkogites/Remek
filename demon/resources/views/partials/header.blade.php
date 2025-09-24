<header class="site-navbar site-navbar-target" role="banner">
  <div class="container">
    <div class="row align-items-center position-relative">
      <div class="col-3 ">
        <div class="site-logo">
          <a href="{{ url('/') }}" class="font-weight-bold site-logo-link">
            <img src="{{ asset('oldal/images/logo.png') }}" alt="Logo" class="brand-logo">
          </a>
        </div>
      </div>
      <div class="col-9  text-right">
        <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>
        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
          <ul class="site-menu main-menu js-clone-nav ml-auto ">
            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
            <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
            <li class="{{ request()->is('trips') ? 'active' : '' }}"><a href="{{ url('/trips') }}" class="nav-link">Trips</a></li>
            <li class="{{ request()->is('blog') ? 'active' : '' }}"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
            <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>

