<!doctype html>
<html lang="en">

<head>
    <title>Teszt Eredmények - Az ideális úti céljaid</title>
    <link rel="icon" type="image/x-icon" href="/oldal/images/logokicsi.png">
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
    <link rel="stylesheet" href="/oldal/css/style.css">

    <style>
        .result-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .result-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .personality-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 24px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .destination-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid #007bff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .destination-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .destination-rank {
            font-size: 48px;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 10px;
        }
        
        .destination-name {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .destination-score {
            background: #e9ecef;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            color: #495057;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .destination-description {
            color: #666;
            line-height: 1.6;
        }
        
        .action-buttons {
            text-align: center;
            margin-top: 40px;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: background 0.3s ease;
        }
        
        .btn-primary:hover {
            background: #0056b3;
            color: white;
            text-decoration: none;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: background 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: #545b62;
            color: white;
            text-decoration: none;
        }
        
        .result-animation {
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
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
                                <img src="/oldal/images/logo.png" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="col-9  text-right">
                        <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>
                        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav ml-auto ">
                                <li><a href="/" class="nav-link">Kezdőlap</a></li>
                                <li><a href="/about" class="nav-link">Rólunk</a></li>
                                <li><a href="/trips" class="nav-link">Utazások</a></li>
                                <li><a href="/contact" class="nav-link">Kapcsolat</a></li>
                                <li><a href="/quiz" class="nav-link">Teszt</a></li>
                                @if(auth()->check())
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
                                @endif
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
                            <h1 class="mb-3 text-white">Teszt Eredmények</h1>
                            <p>Megtaláltuk az ideális úti céljaidat!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section py-5">
            <div class="container">
                <div class="result-container">
                    <div class="result-header result-animation">
                        <h2 class="personality-badge">
                            🎯 Te egy {{ $results['personality'] }} típusú utazó vagy!
                        </h2>
                        <p class="lead">Az alábbi úti célok illenek a legjobban személyiségedhez:</p>
                    </div>

                    @php
                        $destinationNames = [
                            'prague' => 'Prága',
                            'paris' => 'Párizs',
                            'rome' => 'Róma',
                            'amsterdam' => 'Amszterdam',
                            'barcelona' => 'Barcelona',
                            'lisbon' => 'Lisszabon',
                            'vienna' => 'Bécs',
                            'budapest' => 'Budapest',
                            'prague_castle' => 'Prágai Vár',
                            'eiffel_tower' => 'Eiffel-torony',
                            'colosseum' => 'Colosseum',
                            'sagrada_familia' => 'Sagrada Família',
                            'anne_frank_house' => 'Anne Frank Ház',
                            'belem_tower' => 'Belémi torony',
                            'schonbrunn_palace' => 'Schönbrunn Palota',
                            'parliament_hungary' => 'Parlament'
                        ];

                        $destinationDescriptions = [
                            'prague' => 'Európa egyik legszebb fővárosa, lenyűgöző építészettel és történelemmel.',
                            'paris' => 'A szerelem és a művészet városa, ikonikus látnivalókkal és romantikus hangulattal.',
                            'rome' => 'Az örök város, ahol minden sarkon történelem és kultúra vár.',
                            'amsterdam' => 'Művészeti galériák, csatornák és modern, laza hangulat.',
                            'barcelona' => 'Tengerpart, modern építészet és gazdag kulturális élet.',
                            'lisbon' => 'Történelmi negyedek, hagyományos konyha és mediterrán hangulat.',
                            'vienna' => 'Kulturális központ, kávéházak és császári paloták.',
                            'budapest' => 'Történelmi fürdők, impozáns épületek és megfizethető árak.',
                            'prague_castle' => 'Prága szíve, történelmi jelentőségű várkomplexum.',
                            'eiffel_torony' => 'Párizs ikonikus szimbóluma, lenyűgöző kilátással.',
                            'colosseum' => 'Róma ősi amfiteátruma, a római birodalom jelképe.',
                            'sagrada_familia' => 'Gaudi mesterműve, Barcelona egyik leglátogatottabb helye.',
                            'anne_frank_house' => 'Mozgató történelmi élmény Amszterdam szívében.',
                            'belem_tower' => 'Lisszabon történelmi jelképe, a tengeri felfedezések emléke.',
                            'schonbrunn_palace' => 'Bécs császári palotája, kertekkel és gazdag történelemmel.',
                            'parliament_hungary' => 'Budapest ikonikus épülete, a magyar parlament székhelye.'
                        ];
                    @endphp

                    @foreach($results['top_destinations'] as $destination => $score)
                        <div class="destination-card result-animation" style="animation-delay: {{ $loop->iteration * 0.1 }}s">
                            <div class="destination-rank">#{{ $loop->iteration }}</div>
                            <h3 class="destination-name">{{ $destinationNames[$destination] ?? $destination }}</h3>
                            <div class="destination-score">Pontszám: {{ $score }}/15</div>
                            <p class="destination-description">
                                {{ $destinationDescriptions[$destination] ?? 'Egyedülálló úti cél, amely tökéletesen illik hozzád.' }}
                            </p>
                        </div>
                    @endforeach

                    <div class="action-buttons result-animation" style="animation-delay: 0.5s">
                        <a href="/trips" class="btn-primary">
                            🗺️ Úticélok megtekintése
                        </a>
                        <a href="/quiz" class="btn-secondary">
                            🔄 Teszt újból
                        </a>
                        @if(!auth()->check())
                            <a href="/regisztracio" class="btn-primary">
                                👤 Regisztráció és foglalás
                            </a>
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
                                    <li><a href="/quiz">Teszt</a></li>
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
