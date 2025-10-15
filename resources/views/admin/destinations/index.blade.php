@extends('layouts.base')

@section('title', 'Admin – Uticélok')

@section('body')
  <div class="site-section py-5">
    <div class="container">
      @if(session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
      @endif

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="h3 mb-1">Uticélok</h1>
          <div class="text-muted">Admin felület · összesen: {{ $destinations->total() }}</div>
        </div>
        <div>
          <a class="btn btn-primary" href="{{ route('admin.destinations.create') }}">
            + Új uticél
          </a>
        </div>
      </div>

      <div class="card shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
              <thead class="table-light">
                <tr>
                  <th style="width:34%">Cím</th>
                  <th style="width:18%">Slug</th>
                  <th style="width:14%">Ár (HUF)</th>
                  <th style="width:14%">Kezdő</th>
                  <th style="width:14%">Vége</th>
                  <th style="width:6%" class="text-end">Művelet</th>
                </tr>
              </thead>
              <tbody>
                @forelse($destinations as $d)
                <tr>
                  <td class="fw-semibold">{{ $d->title }}</td>
                  <td><code class="small">{{ $d->slug }}</code></td>
                  <td>{{ number_format($d->price_huf, 0, ' ', ' ') }}</td>
                  <td>{{ $d->start_date }}</td>
                  <td>{{ $d->end_date }}</td>
                  <td class="text-end">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.destinations.edit', $d) }}">Szerkesztés</a>
                    <form action="{{ route('admin.destinations.destroy', $d) }}" method="POST" class="d-inline" onsubmit="return confirm('Biztos törli?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" type="submit">Törlés</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-5">Nincs még uticél.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      @if ($destinations->hasPages())
      <div class="mt-3 d-flex justify-content-between align-items-center small text-muted">
        <div>Oldal {{ $destinations->currentPage() }} / {{ $destinations->lastPage() }}</div>
        <div>
          @if ($destinations->previousPageUrl())
            <a class="text-decoration-none me-3" href="{{ $destinations->previousPageUrl() }}">&larr; Előző</a>
          @else
            <span class="me-3">&larr; Előző</span>
          @endif
          @if ($destinations->nextPageUrl())
            <a class="text-decoration-none" href="{{ $destinations->nextPageUrl() }}">Következő &rarr;</a>
          @else
            <span>Következő &rarr;</span>
          @endif
        </div>
      </div>
      @endif
    </div>
  </div>
@endsection

@section('footer')
@endsection
