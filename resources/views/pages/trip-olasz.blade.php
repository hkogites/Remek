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
      <div class="site-section-cover overlay" style="background-image: url('/oldal/images/olasz.jpg')">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-5" data-aos="fade-up">
              <span class="text-white d-block mb-4">Price: <strong>156 000 Ft</strong></span>
              <h1 class="mb-3 text-white">Olaszország</h1>
              <p>Verona romantikája, a Garda-tó nyugalma, Milánó nyüzsgése, a Comói-tó eleganciája és Velence egyedülálló szépsége – mindezt hat napba sűrítve, kényelmes utazással, magyar idegenvezetéssel. Ez a körutazás nem csupán egy kirándulás, hanem egy igazi élménycsomag, ahol a művészet, a természet, a gasztronómia és a történelem találkozik.</p>
              
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">

      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-12">
            <div class="heading-39101 mb-5">
            <span class="backdrop text-center">Utazás részletei</span>
              <span class="subtitle-39191">Utazás</span>
              <h3>Utazás részletei</h3>
            </div>
          </div>
        </div>


        <div class="row mt-5 pt-5">
          <div class="col-md-6">
            <p><b>Észak-Olaszországi körutazás – 6 nap / 5 éjszaka</b>

            Verona – Garda-tó – Sirmione – Milánó – Comói-tó – Bergamo – Velence
            Autóbuszos utazás – 50 fős csoport számára</p><hr>

            <p>1. nap: Indulás – Verona – Garda-tó<br> Indulás: Kora reggeli órákban indulás Magyarországról (pl. Budapest vagy Győr), pihenőkkel útközben. <br>Érkezés Veronába: Kora délután, városnézés helyi idegenvezetővel:
                <ul>
                    <li>Aréna di Verona – a híres római amfiteátrum</li>
                    <li>Julietta háza – a híres erkély</li>
                    <li>Piazza delle Erbe, Piazza dei Signori</li>
                    <li>Továbbutazás a Garda-tóhoz, szállás elfoglalása a tó közelében (pl. Peschiera del Garda vagy Desenzano).</li>
                    <li>Vacsora, szállás a Garda-tónál.</li>

                </ul>

            </p><hr>

            <p>2. nap: Garda-tó – Sirmione – Bergamo<br>

            Délelőtt: Látogatás Sirmionéba, a Garda-tó ékszerdobozába:<br>
            <ul>
                <li>Scaligeri vár, séta az óvárosban</li>
                <li>Fakultatív hajókirándulás a Garda-tavon (kb. 30-45 perc)</li>
                <li>Délután: Továbbutazás Bergamóba</li>
                <li>Siklóval fel a Felsővárosba (Città Alta)</li>
                <li>Piazza Vecchia, Santa Maria Maggiore-bazilika, Colleoni kápolna</li>
            </ul>

            Este: Szállás Bergamo vagy környékén, vacsora.</p><hr>

            <p>3. nap: Milánó – a divat és kultúra fővárosa<br>

            Egész napos kirándulás Milánóba, városnézés:<br>
            <ul>
                <li>Milánói dóm, a világ egyik legnagyobb katedrálisa</li>
                <li>Galleria Vittorio Emanuele II</li>
                <li>La Scala operaház</li>
                <li>Fotószünet a Castello Sforzesco előtt</li>
                <li>Szabadidő vásárlásra vagy egyéni felfedezésre.</li>
            </ul>
            Visszautazás a szállásra, vacsora.</p><hr>


            <p><b>4. nap:</b> Comói-tó – Tremezzo – Bellagio (fakultatív hajókirándulás)<br>

            Kirándulás a festői Comói-tóhoz:<br>
            <ul>
                <li>Látogatás Como városába – Dóm, tóparti sétány</li>
                <li>Fakultatív hajókirándulás a tavon: Tremezzo (Villa Carlotta) és Bellagio – a tó gyöngyszeme</li>
                <li>Visszatérés a szállásra a kora esti órákban.</li>
            </ul>
            Vacsora, szállás.</p><hr>

            <p>5. nap: Velence – a lagúnák városa<br>

            Kora reggeli indulás Velencébe, átszállás hajóra Punta Sabbioni kikötőjében.<br>
            Városnézés Velencében:<br>
            <ul>
                <li>Szent Márk tér, Bazilika, Dózse-palota, Campanile</li>
                <li>Rialto-híd, Canale Grande</li>
                <li>Szabadidő, vásárlási lehetőség, kávézás a híres kávézókban.</li>
                <li>Késő délután visszatérés a kikötőbe, utazás a szállásra Velence környékén (pl. Mestre vagy Lido di Jesolo).</li>
                <li>Vacsora, szállás.</li>
            </ul>

            </p><hr>

            <p>6. nap: Hazautazás – Udine vagy Grado (megálló útközben)<br>

            Reggeli után indulás Magyarország felé.<br>
            <ul>
                <li>Útközbeni rövid megálló Udine vagy a tengerparti Grado városában, pihenő, szabadprogram.</li>
                <li>Érkezés Magyarországra az esti órákban.</li>
            </ul>
            </p><hr>

            <p>Részvételi díj tartalmazza:<br>
            <ul>
                <li>Kényelmes, légkondicionált, 50 fős autóbusz bérleti díját</li>
                <li>5 éjszaka szállást 3*-os szállodákban, reggelivel és vacsorával</li>
                <li>Helyi idegenvezetést Veronában, Milánóban és Velencében</li>
                <li>Útlemondási biztosítás</li>
                <li>Magyar nyelvű csoportkísérőt</li>
            </ul>
            </p><hr>
            <p>Ár: 156.000 Ft / fő</p><hr>


            <p><a href="/contact" class="btn btn-primary py-3 px-4 my-4">Contact Us</a></p>
          </div>
          <div class="col-md-6">
            <img src="/oldal/images/olasz.jpg" alt="Image" class="img-fluid">
          </div>
        </div>

      </div>
    </div>


    
    </div>


    

    <footer class="site-footer bg-light">
      <div class="container">
        <div class="row">
<<<<<<< HEAD
          <div class="col-lg-3">
            <h2 class="footer-heading mb-3">Instagram</h2>
            <div class="row">
              <div class="col-4 gal_col">
                <a href="/trips"><img src="/oldal/images/olasz.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="/trips"><img src="/oldal/images/mallorca.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="/trips"><img src="/oldal/images/norvég.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="/trips"><img src="/oldal/images/török.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="/trips"><img src="/oldal/images/praga.jpg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="col-4 gal_col">
                <a href="/trips"><img src="/oldal/images/lisbon.jpg" alt="Image" class="img-fluid"></a>
              </div>
            </div>
=======
>>>>>>> 402e2fc82c5bcf1443789af573a3376b720a2836
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
