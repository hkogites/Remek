<!doctype html>
<html lang="en">

<head>
    <title>SmartVoyager - Utazások</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/oldal/images/ikon.png">

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
        .listing-item {
            position: relative;
            box-shadow: none;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .listing-item .listing-image {
            width: 100%;
            overflow: hidden;
            position: relative;
            border-radius: 8px;
            aspect-ratio: 16/9;
            box-shadow: none;
        }
        
        .listing-item .listing-image img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .listing-item:hover .listing-image img {
            transform: scale(1.05);
        }
        
        /* Remove any template gradient overlays */
        .listing-item:before,
        .listing-item:after,
        .listing-item .listing-image:before,
        .listing-item .listing-image:after {
            content: none !important;
            background: none !important;
            box-shadow: none !important;
        }
        
        .listing-item .overlay-bottom {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 20px 16px;
            background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 45%, rgba(0,0,0,0.4) 75%, rgba(0,0,0,0) 100%);
            color: white;
            text-align: center;
            z-index: 1;
        }
        
        .trip-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        
        .trip-date {
            font-size: 14px;
            color: rgba(255,255,255,0.9);
            margin-top: 5px;
        }
        
        .trip-price-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255,255,255,0.95);
            color: #333;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            z-index: 2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        
        .stretched-card-link {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
        
        .season-filter-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        
        .season-btn {
            padding: 12px 24px;
            border: 2px solid #007bff;
            background: transparent;
            color: #007bff;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            min-width: 120px;
            text-align: center;
        }
        
        .season-btn:hover {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
            box-shadow: 0 4px 8px rgba(0,123,255,0.3);
            text-decoration: none;
        }
        
        .season-btn.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
            box-shadow: 0 4px 12px rgba(0,123,255,0.4);
        }
        
        .season-btn-all {
            color: #6c757d;
            border-color: #6c757d;
        }
        
        .season-btn-all:hover {
            background-color: #6c757d;
            color: #fff;
            border-color: #6c757d;
            box-shadow: 0 4px 8px rgba(108,117,125,0.3);
        }
        
        .season-btn-all.active {
            background-color: #6c757d;
            color: #fff;
            border-color: #6c757d;
            box-shadow: 0 4px 12px rgba(108,117,125,0.4);
        }
        
        @media (max-width: 768px) {
            .season-filter-container {
                gap: 8px;
            }
            .season-btn {
                min-width: 100px;
                height: 44px;
                padding: 0 16px;
                font-size: 12px;
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

    @include('components.navbar')

    <div class="ftco-blocks-cover-1">
        <div class="site-section-cover overlay" style="background-image: url('/oldal/images/banner.png'); height: 500px;">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center h-100">
                    <div class="col-md-12 d-flex align-items-center justify-content-center h-100">
                        <div class="heading-39101 mb-5 text-center">
                            <h1 class="mb-3 font-weight-bold text-white">Utazási ajánlataink</h1>
                            <p class="lead text-white">Fedezze fel szezonális úti céljainkat!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="season-filter-container">
                        <a href="{{ url('/trips') }}?season=1" class="season-btn {{ ($selectedSeason===1) ? 'active' : '' }}">TÉL</a>
                        <a href="{{ url('/trips') }}?season=2" class="season-btn {{ ($selectedSeason===2) ? 'active' : '' }}">TAVASZ</a>
                        <a href="{{ url('/trips') }}?season=3" class="season-btn {{ ($selectedSeason===3) ? 'active' : '' }}">NYÁR</a>
                        <a href="{{ url('/trips') }}?season=4" class="season-btn {{ ($selectedSeason===4) ? 'active' : '' }}">ŐSZ</a>
                        <a href="{{ url('/trips') }}" class="season-btn season-btn-all {{ ($selectedSeason===null) ? 'active' : '' }}">ÖSSZES</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                @foreach(($destinations ?? []) as $d)
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                    <div class="listing-item">
                        <div class="listing-image">
                            <img src="{{ $d->image_path }}" alt="{{ $d->title }}" class="img-fluid">
                            <span class="trip-price-badge">{{ number_format($d->price_huf, 0, ' ', ' ') }} FT</span>
                            <div class="overlay-bottom">
                                <h2 class="trip-title">{{ $d->title }}</h2>
                                @if($d->start_date && $d->end_date)
                                    <span class="trip-date">{{ \Illuminate\Support\Carbon::parse($d->start_date)->format('Y.m.d') }}-{{ \Illuminate\Support\Carbon::parse($d->end_date)->format('m.d') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('trip.show', $d->slug) }}" class="stretched-card-link" aria-label="{{ $d->title }}"></a>
                        </div>
                    </div>
                </div>
                @endforeach
                @if(($destinations ?? collect())->isEmpty())
                    <div class="col-12 text-center text-muted py-5">
                        <h4>Nincs találat az adott évszakban.</h4>
                        <p class="mt-3">Próbálja meg egy másik évszak kiválasztását, vagy tekintse meg az összes úti célt!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('partials.footer')

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
