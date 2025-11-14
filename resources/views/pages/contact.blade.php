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

      @include('components.navbar')



    <div class="ftco-blocks-cover-1">
      <div class="site-section-cover overlay" style="background-image: url('/oldal/images/banner.png')">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-5" data-aos="fade-up">
              <h1 class="mb-3 text-white">Kapcsolatfelvétel</h1>
              <p>Probléma merült fel? Lépjen kapcsolatba velünk, és utazása biztonságát gyorsan rendezni fogjuk. Kérjük, ne habozzon! Ne késlekedjen, segítünk! Kérjük, írjon nekünk! Kérjük, kérjük ne várjon sokáig! Hamarosan válaszolunk Önnek! Kérjük, keressen minket!</p>
              
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-10">
            <div class="heading-39101 mb-5">
              <span class="backdrop text-center">Kapcsolat</span>
              <span class="subtitle-39191">Lépjen kapcsolatba velünk!</span>
              <h3>Kapcsolatfelvétel</h3>
            </div>
          </div>
        </div>
       
        <div class="row">
          <div class="col-lg-8 mb-5" >
            @if(session('status'))
              <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{ route('contact.send') }}" method="post">
              @csrf
              <div class="form-group row">
                <div class="col-md-6 mb-4 mb-lg-0">
                  <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="Keresztnév" required>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Vezetéknév (nem kötelező)">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail cím" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <textarea name="message" id="message" class="form-control" placeholder="Írja meg üzenetét..." cols="30" rows="10" required>{{ old('message') }}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 mr-auto">
                  <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Send Message">
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-4 ml-auto">
            <div class="bg-white p-3 p-md-5">
              <h3 class="text-black mb-4">Elérhetőségeink</h3>
              <ul class="list-unstyled footer-link">
                <li class="d-block mb-3">
                  <span class="d-block text-black">Cím:</span>
                  <span>Kaposvár, Pázmány Péter u. 17, 7400</span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Telefon:</span><span>+36 30 911 2222</span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span>hkogites@gmail.com</span></li>
              </ul>
            </div>
          </div>
        </div>
        
      </div>
    </div> <!-- END .site-section -->

    

    <footer class="site-footer bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
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

