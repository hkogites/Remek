<!doctype html>
<html lang="hu">

  <head>
    <title>{{ $destination->title }} - SmartVoyager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/oldal/fonts/icomoon/style.css">

    <link rel="stylesheet" href="/oldal/css/bootstrap.min.css">
    <link rel="stylesheet" href="/oldal/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/oldal/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/oldal/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/oldal/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/oldal/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="/oldal/css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/oldal/css/style.css">

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
                <a href="/" class="font-weight-bold">
                  <img src="/oldal/images/logo.png" alt="Image" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-9  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li><a href="/" class="nav-link">Kezdőlap</a></li>
                  <li><a href="/about" class="nav-link">Rólunk</a></li>
                  <li class="active"><a href="/trips" class="nav-link">Utazások</a></li>
                  <li><a href="/contact" class="nav-link">Kapcsolat</a></li>
                  @auth
                  <li><a href="{{ route('profile') }}" class="nav-link">Profil</a></li>
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

    <div class="ftco-blocks-cover-1">
      <div class="site-section-cover overlay" style="background-image: url('{{ $destination->image_path }}')">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-5" data-aos="fade-up">
              <span class="text-white d-block mb-4">Ár: <strong>{{ number_format($destination->price_huf, 0, ' ', ' ') }} Ft</strong></span>
              <h1 class="mb-3 text-white">{{ $destination->title }}</h1>
              @if($destination->start_date && $destination->end_date)
              <p>{{ \Illuminate\Support\Carbon::parse($destination->start_date)->format('Y.m.d') }} - {{ \Illuminate\Support\Carbon::parse($destination->end_date)->format('Y.m.d') }}</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>


  <div class="site-section">

    <div class="container">
      @if(session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
      @endif

        <div class="row mt-3 pt-3">
          @if(!empty($destination->leiras))
            <div class="col-md-12">
              {!! $destination->leiras !!}
          @else
            <div class="col-md-6">
              <p>Ez az oldal dinamikusan jött létre az adatbázis bejegyzés alapján. Itt jeleníthetünk meg részletes leírást, útitervet, szolgáltatásokat, stb.</p>
              <p><a href="/contact" class="btn btn-primary py-3 px-4 my-4">Kapcsolat</a></p>
            </div>
            <div class="col-md-6">
              <img src="{{ $destination->image_path }}" alt="{{ $destination->title }}" class="img-fluid">
            </div>
          @endif
        </div>

        <div class="row mt-4">
          <div class="col-md-12 text-center">
            @auth
              @if(!empty($isFull) && $isFull)
                <a class="btn btn-secondary disabled" href="#" aria-disabled="true" style="pointer-events:none; opacity:0.7;">Betelt</a>
              @else
                <a class="btn btn-primary" href="{{ route('reservations.create', $destination->slug) }}">Lefoglalom</a>
              @endif
            @else
              <a class="btn btn-outline-primary" href="{{ route('login') }}">Bejelentkezés a foglaláshoz</a>
            @endauth
            @if(!empty($limit))
              <p class="mt-2 text-muted">Foglalások: {{ $currentReservations }}{{ $limit ? ' / '.$limit : '' }}</p>
            @endif
          </div>
        </div>

      </div>
    </div>


    <footer class="site-footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ml-auto">
            <div class="row">
            <div class="col-lg-6 ml-auto">
                <h2 class="footer-heading mb-4">Gyors elérés</h2>
                <ul class="list-unstyled">
                  <li><a href="/">Kezdőlap</a></li>
                  <li><a href="/about">Rólunk</a></li>
                  <li><a href="/trips">Utazások</a></li>
                  <li><a href="/contact">Kapcsolat</a></li>
                  <li><a href="/blog">Regisztráció</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <h2 class="footer-heading mb-4">Köszönjük!</h2>
                <p>Köszönjük, hogy minket választott! Reméljük, hogy megfeleltünk elvárásainak!</p>
              </div>
              
            </div>
          </div>
        </div>
        
      </div>
    </footer>

    </div>

    <script src="/oldal/js/jquery-3.3.1.min.js"></script>
    <script src="/oldal/js/jquery-migrate-3.0.0.js"></script>
    <script src="/oldal/js/popper.min.js"></script>
    <script src="/oldal/js/bootstrap.min.js"></script>
    <script src="/oldal/js/owl.carousel.min.js"></script>
    <script src="/oldal/js/jquery.sticky.js"></script>
    <script src="/oldal/js/jquery.waypoints.min.js"></script>
    <script src="/oldal/js/jquery.animateNumber.min.js"></script>
    <script src="/oldal/js/jquery.fancybox.min.js"></script>
    <script src="/oldal/js/jquery.stellar.min.js"></script>
    <script src="/oldal/js/jquery.easing.1.3.js"></script>
    <script src="/oldal/js/bootstrap-datepicker.min.js"></script>
    <script src="/oldal/js/isotope.pkgd.min.js"></script>
    <script src="/oldal/js/aos.js"></script>

    <script src="/oldal/js/main.js"></script>

  </body>

</html>
