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
      .listing-item{position:relative;box-shadow:none}
      .listing-item .listing-image{width:100%;overflow:hidden;position:relative;border-radius:4px;aspect-ratio:3/5;box-shadow:none}
      .listing-item .listing-image img{width:100%;height:100%;display:block}
      /* turn off any template gradient overlays */
      .listing-item:before,
      .listing-item:after,
      .listing-item .listing-image:before,
      .listing-item .listing-image:after{content:none !important;background:none !important;box-shadow:none !important}
      .listing-item .overlay-bottom{position:absolute;left:0;right:0;bottom:0;padding:28px 16px 20px;background:linear-gradient(0deg, rgba(36,34,34,0.80) 0%, rgba(36,34,34,0.60) 45%, rgba(36,34,34,0.40) 75%, rgba(36,34,34,0) 100%);color:white;text-align:center;z-index:1}
      .trip-title{margin:0;font-size:18px;font-weight:600;color:white;}
      .trip-date{display:block;margin-top:6px;color:white;font-size:16px}
      .trip-price-badge{position:absolute;left:50%;bottom:84px;transform:translateX(-50%);background:#1f5fbf;color:#fff;border-radius:18px;padding:8px 14px;font-weight:700;font-size:12px;letter-spacing:.08em;box-shadow:none;z-index:2}
      .stretched-card-link{position:absolute;inset:0;z-index:10}
      .trips-season-filter{margin-bottom:24px}
      
      /* Season filter buttons styling */
      .season-filter-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        margin-bottom: 40px;
        flex-wrap: wrap;
      }
      
      .season-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 120px;
        height: 48px;
        padding: 0 24px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        text-decoration: none;
        color:rgb(111, 158, 230);
        background-color: transparent;
        border: 2px solid rgb(111, 158, 230);
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }
      
      .season-btn:hover {
        background-color: rgb(111, 158, 230);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
      }
      
      .season-btn.active {
        background-color: rgb(111, 158, 230);
        color: #fff;
        border-color:rgb(111, 158, 230);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
      }
      
      .season-btn-all {
        color: #6c757d;
        border-color: #6c757d;
      }
      
      .season-btn-all:hover {
        background-color: #6c757d;
        color: #fff;
        border-color: #6c757d;
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
      }
      
      .season-btn-all.active {
        background-color: #6c757d;
        color: #fff;
        border-color: #6c757d;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.4);
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

@include('components.navbar')

    <div class="ftco-blocks-cover-1">
      <div class="site-section-cover overlay" style="background-image: url('/oldal/images/banner.png'); height: 500px;">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center h-100">
            <div class="col-md-12 d-flex align-items-center justify-content-center h-100">
              <div class="heading-39101 mb-5 text-center">
                <h3>Utazási ajánlataink</h3>
              </div>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .site-section-cover -->
  </div> <!-- .ftco-blocks-cover-1 -->

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
          <div class="col-12 text-center text-muted">Nincs találat az adott évszakban.</div>
        @endif
      </div>
      </div>
    </div> <!-- .container -->
  </div> <!-- .site-section -->

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
          </ul>
        </div>
        <div class="col-lg-6">
          <h2 class="footer-heading mb-4">Köszönjük!</h2>
          <p>Köszönjük, hogy minket választott! Reméljük, hogy megfeleltünk elvárásainak!</p>
        </div>
      </div>
    </div>
  </footer>
    </div> <!-- end .site-wrap -->
    <style>
      .site-section { padding-top: 60px; padding-bottom: 60px; }
      /* Fix overlapping hero title on trips page */
      .ftco-blocks-cover-1 .heading-39101 .backdrop,
      .ftco-blocks-cover-1 .heading-39101 .subtitle-39191 {
        display: none !important;
      }
      .ftco-blocks-cover-1 .heading-39101 h3 {
        font-size: 48px;
        color: #fff;
        margin: 0;
        text-shadow: 0 2px 8px rgba(0,0,0,0.35);
        font-weight: bold;
        line-height: 1.2;
      }
    </style>
    <script src="/oldal/js/jquery.animateNumber.min.js"></script>
    <script src="/oldal/js/jquery.fancybox.min.js"></script>
    <script src="/oldal/js/jquery.stellar.min.js"></script>
    <script src="/oldal/js/jquery.easing.1.3.js"></script>
    <script src="/oldal/js/isotope.pkgd.min.js"></script>
    <script src="/oldal/js/aos.js"></script>

    <script src="/oldal/js/main.js"></script>

  </body>

</html>

