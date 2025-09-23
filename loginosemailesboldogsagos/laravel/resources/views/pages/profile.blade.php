@extends('layouts.base')

@section('title', 'Profil')

@section('body')
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2 class="mb-4">Profil</h2>

        @if(session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
          <div class="card-body">
            <p class="mb-2"><strong>Név:</strong> {{ auth()->user()->name }}</p>
            <p class="mb-2"><strong>E-mail:</strong> {{ auth()->user()->email }}</p>
            
          </div>
        </div>

        <div class="mt-4">
          <a href="{{ url('/') }}" class="btn btn-secondary">Vissza a kezdőlapra</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


