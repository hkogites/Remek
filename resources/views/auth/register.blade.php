@extends('layouts.base')

@section('title', 'Regisztráció')

@section('body')
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="mb-4">Regisztráció</h2>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ url('/regisztracio') }}">
          @csrf
          <div class="form-group">
            <label for="name">Név</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required>
          </div>
          <div class="form-group">
            <label for="email">E-mail cím</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
          </div>
          <div class="form-group">
            <label for="password">Jelszó</label>
            <input id="password" type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password_confirmation">Jelszó megerősítése</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
          </div>
          <div class="form-group d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">Regisztráció</button>
            <a href="{{ url('/bejelentkezes') }}">Már van fiókja? Bejelentkezés</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection
