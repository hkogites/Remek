<!doctype html>
<html lang="hu">
  <head>
    <title>Foglalás - {{ $destination->title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/oldal/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/oldal/css/bootstrap.min.css">
    <link rel="stylesheet" href="/oldal/css/style.css">
  </head>
  <body>

  <div class="site-wrap" id="home-section">
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
            <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
              <ul class="site-menu main-menu js-clone-nav ml-auto ">
                <li><a href="/" class="nav-link">Kezdőlap</a></li>
                <li><a href="/trips" class="nav-link">Utazások</a></li>
                <li><a href="{{ route('trip.show', $destination->slug) }}" class="nav-link">Vissza: {{ $destination->title }}</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h2 class="mb-4">Foglalás: {{ $destination->title }}</h2>
            @if(isset($limit))
              <p class="text-muted">Jelenlegi foglalások: {{ $currentReservations }}{{ $limit ? ' / '.$limit : '' }}</p>
            @endif

            @if(session('status'))
              <div class="alert alert-info">{{ session('status') }}</div>
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

            <form method="POST" action="{{ route('reservations.store', $destination->slug) }}" class="bg-white p-4 shadow-sm rounded">
              @csrf
              <div class="form-group">
                <label>Teljes név</label>
                <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->name ?? '') }}" required>
              </div>
              <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
              </div>
              <div class="form-group">
                <label>Telefonszám</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
              </div>
              <div class="form-group">
                <label>Cím</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Irányítószám, Város, Utca házszám">
              </div>
              <div class="form-group">
                <label>Fő</label>
                <input type="number" name="people_count" min="1" max="20" class="form-control" value="{{ old('people_count', 1) }}" required>
              </div>
              <div class="form-group">
                <label>Megjegyzés</label>
                <textarea name="note" class="form-control" rows="4" placeholder="Egyéb kérés, megjegyzés">{{ old('note') }}</textarea>
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary mr-2">Foglalás elküldése</button>
                <a href="{{ route('trip.show', $destination->slug) }}" class="btn btn-outline-secondary">Mégse</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <footer class="site-footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <h2 class="footer-heading mb-3">Ide majd kitalálunk valamit</h2>
            <div class="row">
              <div class="col-4 gal_col"><a href="#"><img src="/oldal/images/insta_1.jpg" class="img-fluid" alt=""></a></div>
              <div class="col-4 gal_col"><a href="#"><img src="/oldal/images/insta_2.jpg" class="img-fluid" alt=""></a></div>
              <div class="col-4 gal_col"><a href="#"><img src="/oldal/images/insta_3.jpg" class="img-fluid" alt=""></a></div>
              <div class="col-4 gal_col"><a href="#"><img src="/oldal/images/insta_4.jpg" class="img-fluid" alt=""></a></div>
              <div class="col-4 gal_col"><a href="#"><img src="/oldal/images/insta_5.jpg" class="img-fluid" alt=""></a></div>
              <div class="col-4 gal_col"><a href="#"><img src="/oldal/images/insta_6.jpg" class="img-fluid" alt=""></a></div>
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

  <script src="/oldal/js/bootstrap.min.js"></script>
  </body>
</html>
