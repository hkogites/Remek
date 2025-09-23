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
            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}" class="nav-link">Kezdőlap</a></li>
            <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}" class="nav-link">Rólunk</a></li>
            <li class="{{ request()->is('trips') ? 'active' : '' }}"><a href="{{ url('/trips') }}" class="nav-link">Utazások</a></li>
            <li class="{{ request()->is('blog') ? 'active' : '' }}"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
            <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" class="nav-link">Kapcsolat</a></li>
            @auth
              <li class="{{ request()->is('profil') ? 'active' : '' }}"><a href="{{ route('profile') }}" class="nav-link">Profil</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                  @csrf
                  <button type="submit" class="nav-link p-0" style="display:inline; background:none; border:0; padding:0; font: inherit; color: inherit; cursor:pointer;">Kijelentkezés</button>
                </form>
              </li>
            @else
              <li class="{{ request()->is('bejelentkezes') ? 'active' : '' }}"><a href="{{ url('/bejelentkezes') }}" class="nav-link">Bejelentkezés</a></li>
              <li class="{{ request()->is('regisztracio') ? 'active' : '' }}"><a href="{{ url('/regisztracio') }}" class="nav-link">Regisztráció</a></li>
            @endauth
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>

