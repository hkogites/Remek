<header class="site-navbar site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-3 ">
              <div class="site-logo">
                <a href="/" class="font-weight-bold">
                  <img src="/oldal/images/logo.png" alt="Image" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-9  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li class="active"><a href="/" class="nav-link">Kezdőlap</a></li>
                  <li><a href="/about" class="nav-link">Rólunk</a></li>
                  <li><a href="/trips" class="nav-link">Utazások</a></li>
                  <li><a href="/contact" class="nav-link">Kapcsolat</a></li>
                  @auth
                  @if(auth()->user()->is_admin)
                  <li><a href="{{ url('/admin') }}" class="nav-link">Admin</a></li>
                  @endif
                  <li><a href="{{ route('profile') }}" class="nav-link">Profil</a></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                      @csrf
                      <button type="submit" class="nav-link p-0" style="display:inline; background:none; border:0; padding:0; font: inherit; color: inherit; cursor:pointer;">Kijelentkezés</button>
                    </form>
                  </li>
                  @else
                  <li><a href="/quiz" class="nav-link">Kvíz</a></li>
                  <li><a href="{{ url('/bejelentkezes') }}" class="nav-link">Bejelentkezés</a></li>
                  <li><a href="{{ url('/regisztracio') }}" class="nav-link">Regisztráció</a></li>
                  @endauth

                </ul>
              </nav>
            </div>

            
          </div>
        </div>

      </header>
