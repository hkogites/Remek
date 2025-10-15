<!doctype html>
<html lang="en">

  <head>
    <title>SmartVoyager</title>
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

      <style>
      .listing-item .listing-image{width:100%;height:500px;overflow:hidden}
      .listing-item .listing-image img{width:100%;height:100%;object-fit:cover;display:block}
    </style>

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
      <div class="site-section-cover overlay" style="background-image: url('/oldal/images/banner.png')">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-5" data-aos="fade-up">
              <h1 class="mb-3 text-white">Utazási lista</h1>
              <p>Találd meg a hozzád legjobban illő uticélt.</p>
              
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">

      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-7">
            <div class="heading-39101 mb-5">
              <span class="backdrop text-center">Utazások</span>
              <span class="subtitle-39191">Utazások</span>
              <h3>Utazási ajánlataink</h3>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach(($destinations ?? []) as $d)
          <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
            <div class="listing-item">
              <div class="listing-image">
                <a href="{{ route('trip.show', $d->slug) }}">
                  <img src="{{ $d->image_path }}" alt="{{ $d->title }}" class="img-fluid">
                </a>
              </div>
              <div class="listing-item-content">
                <a class="px-3 mb-3 category bg-primary" href="{{ route('trip.show', $d->slug) }}">{{ number_format($d->price_huf, 0, ' ', ' ') }} Ft</a>
                <h2 class="mb-1">
                  <a href="{{ route('trip.show', $d->slug) }}">
                    {{ $d->title }}<br>
                    @if($d->start_date && $d->end_date)
                      {{ \Illuminate\Support\Carbon::parse($d->start_date)->format('Y.m.d') }}-{{ \Illuminate\Support\Carbon::parse($d->end_date)->format('m.d') }}
                    @endif
                  </a>
                </h2>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </div>





    

    <footer class="site-footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <h2 class="footer-heading mb-3">Ide majd kitalálunk valamit</h2>
            <div class="row">
              <div class="col-4 gal_col">
                <a href="#"><img src="/oldal/images/insta_1.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="#"><img src="/oldal/images/insta_2.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="#"><img src="/oldal/images/insta_3.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="#"><img src="/oldal/images/insta_4.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="#"><img src="/oldal/images/insta_5.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="#"><img src="/oldal/images/insta_6.jpg" alt="Image" class="img-fluid"></a>
              </div>
            </div>
          </div>
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

