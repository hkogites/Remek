<!doctype html>
<html lang="hu">
<head>
    <title>Kvíz Eredmény - SmartVoyager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="/oldal/images/logokicsi.png">
    
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

        <style>
            .result-container {
                min-height: 100vh;
                padding: 80px 0;
                background: linear-gradient(135deg, rgba(50, 80, 212, 0.53));
            }
            .result-header {
                text-align: center;
                color: white;
                margin-bottom: 50px;
            }
            .result-header h1 {
                font-size: 48px;
                font-weight: 900;
                margin-bottom: 15px;
            }
            .result-header p {
                font-size: 20px;
                opacity: 0.9;
            }
            .destination-card {
                background: white;
                border-radius: 20px;
                overflow: hidden;
                margin-bottom: 30px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                transition: transform 0.3s ease;
            }
            .destination-card .row { align-items: stretch; }
            .destination-card .col-md-5, .destination-card .col-md-7 { display: flex; }
            .destination-card .col-md-7 { flex-direction: column; }
            .destination-card:hover {
                transform: translateY(-5px);
            }
            .destination-card.top-match {
                border: 4px solidrgba(255, 217, 0, 0.53);
                box-shadow: 0 15px 50px rgba(104, 97, 206, 0.78);
            }
            .destination-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center bottom; /* igazítás az alakzat aljához */
            }
            .destination-content {
                padding: 30px;
            }
            @media (max-width: 767.98px) {
                .destination-card .col-md-5, .destination-card .col-md-7 { display: block; }
                .destination-image { height: 300px; object-position: center; }
            }
            .destination-badge {
                display: inline-block;
                color: white;
                padding: 8px 20px;
                border-radius: 20px;
                font-size: 14px;
                font-weight: 700;
                margin-bottom: 15px;
            }
            .destination-badge.top {

                color: #333;
            }
            .destination-title {
                font-size: 32px;
                font-weight: 700;
                color: #333;
                margin-bottom: 15px;
            }
            .destination-price {
                font-size: 24px;
                color: #667eea;
                font-weight: 700;
                margin-bottom: 20px;
            }
            .destination-dates {
                color: #666;
                margin-bottom: 20px;
                font-size: 16px;
            }
            .btn-reserve {
                display: inline-block;
                background: linear-gradient(135deg, #667eea 0%,rgba(118, 75, 162, 0.78) 100%);
                color: white;
                padding: 14px 40px;
                border-radius: 30px;
                text-decoration: none;
                font-weight: 700;
                font-size: 16px;
                transition: all 0.3s ease;
                border: none;
            }
            .btn-reserve:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
                color: white;
                text-decoration: none;
            }
            .btn-retake {
                display: inline-block;
                background: white;
                color: #667eea;
                padding: 14px 40px;
                border-radius: 30px;
                text-decoration: none;
                font-weight: 700;
                font-size: 16px;
                transition: all 0.3s ease;
                margin-top: 30px;
            }
            .btn-retake:hover {
                background: #f8f9ff;
                color: #667eea;
                text-decoration: none;
            }
        </style>

        <div class="result-container">
            <div class="container">
                <div class="result-header">
                    <h1>🎉 {{ $resultType['title'] }}</h1>
                    <p>{{ $resultType['description'] }}</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="destination-card top-match" data-aos="fade-up">
                            <div class="row no-gutters">
                                <div class="col-md-5">
                                    <img src="{{ $destination->image_path }}" alt="{{ $destination->title }}" class="destination-image">
                                </div>
                                <div class="col-md-7">
                                    <div class="destination-content">
                                        <span class="destination-badge top">Ajánlott utazás számodra</span>
                                        
                                        <h2 class="destination-title">{{ $destination->title }}</h2>
                                        
                                        <div class="destination-price">
                                            {{ number_format($destination->ar, 0, ' ', ' ') }} Ft
                                        </div>
                                        
                                        @if($destination->start_date && $destination->end_date)
                                        <div class="destination-dates">
                                            📅 {{ \Illuminate\Support\Carbon::parse($destination->start_date)->format('Y. m. d.') }} - 
                                            {{ \Illuminate\Support\Carbon::parse($destination->end_date)->format('Y. m. d.') }}
                                        </div>
                                        @endif
                                        
                                        <div style="margin-top: 20px; display: flex; flex-wrap: wrap; gap: 15px;">
                                            <a href="{{ route('trip.show', $destination->slug) }}" class="btn-reserve" style="margin-right: 15px;">
                                                Részletek és foglalás
                                            </a>
                                            @auth
                                            <a href="{{ route('reservations.create', $destination->slug) }}" class="btn-reserve" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                                                Azonnali foglalás
                                            </a>
                                            @else
                                            <a href="{{ route('login') }}" class="btn-reserve" style="background: linear-gradient(135deg,rgb(10, 107, 104) 0%,#764ba2 100%);">
                                                Bejelentkezés a foglaláshoz
                                            </a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center" style="margin-top: 50px;">
                    <a href="/quiz" class="btn-retake">🔄 Kvíz újrakezdése</a>
                    <a href="/trips" class="btn-retake" style="margin-left: 15px;">📋 Összes utazás megtekintése</a>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="/oldal/js/jquery.animateNumber.min.js"></script>
        <script src="/oldal/js/jquery.fancybox.min.js"></script>
        <script src="/oldal/js/jquery.stellar.min.js"></script>
        <script src="/oldal/js/jquery.easing.1.3.js"></script>
        <script src="/oldal/js/isotope.pkgd.min.js"></script>
        <script src="/oldal/js/aos.js"></script>
        <script src="/oldal/js/main.js"></script>
    </div>
</body>
</html>
