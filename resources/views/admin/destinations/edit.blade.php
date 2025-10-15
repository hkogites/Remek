@extends('layouts.base')

@section('title', 'Admin – Uticél szerkesztése')

@section('body')
  <div class="site-section py-5">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Uticél szerkesztése</h1>
        <a class="btn btn-light" href="{{ route('admin.destinations.index') }}">Vissza</a>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card shadow-sm">
        <div class="card-body">
          <form method="POST" action="{{ route('admin.destinations.update', $destination) }}">
            @csrf
            @method('PUT')
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Cím</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $destination->title) }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $destination->slug) }}" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Ár (HUF)</label>
                <input type="number" name="price_huf" class="form-control" value="{{ old('price_huf', $destination->price_huf) }}" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Kezdő dátum</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $destination->start_date) }}">
              </div>
              <div class="col-md-4">
                <label class="form-label">Vége dátum</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $destination->end_date) }}">
              </div>
              <div class="col-md-6">
                <label class="form-label">Kép (lista) - image_path</label>
                <input type="text" name="image_path" class="form-control" value="{{ old('image_path', $destination->image_path) }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Kép (banner) - image2_path</label>
                <input type="text" name="image2_path" class="form-control" value="{{ old('image2_path', $destination->image2_path) }}">
              </div>
              <div class="col-md-12">
                <label class="form-label">Részletes URL (opcionális)</label>
                <input type="text" name="detail_url" class="form-control" value="{{ old('detail_url', $destination->detail_url) }}">
              </div>
              <div class="col-12">
                <label class="form-label">Leírás (HTML megengedett)</label>
                <textarea name="leiras" class="form-control" rows="8">{{ old('leiras', $destination->leiras) }}</textarea>
              </div>
            </div>
            <div class="mt-4 d-flex gap-2">
              <button type="submit" class="btn btn-primary">Mentés</button>
              <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-secondary">Mégse</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
