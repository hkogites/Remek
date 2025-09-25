@extends('layouts.base')

@section('title', 'Bejelentkezés')

@section('body')
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="mb-4">Bejelentkezés</h2>

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

        <form method="POST" action="{{ url('/bejelentkezes') }}">
          @csrf
          <div class="form-group">
            <label for="email">E-mail cím</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
          </div>
          <div class="form-group">
            <label for="password">Jelszó</label>
            <input id="password" type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Emlékezz rám</label>
          </div>
          <div class="form-group d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">Bejelentkezés</button>
            <a href="{{ url('/regisztracio') }}">Nincs fiókja? Regisztráció</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection
