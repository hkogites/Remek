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
        <p>Üdv, {{ ($user->name ?? auth()->user()->name) ?? 'Felhasználó' }}!</p>

        <hr>
        <h4 class="mb-3">Foglalásaim</h4>
        @if(!empty($reservations) && count($reservations) > 0)
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Úti cél</th>
                  <th>Dátum</th>
                  <th>Státusz</th>
                  <th>Művelet</th>
                </tr>
              </thead>
              <tbody>
                @foreach($reservations as $res)
                  <tr>
                  <td>
                    @if($res->destination)
                      <a href="{{ route('trip.show', $res->destination->slug) }}">{{ $res->destination->title }}</a>
                    @else
                      -
                    @endif
                  </td>
                  <td>
                    @if($res->destination && $res->destination->start_date && $res->destination->end_date)
                      {{ \Illuminate\Support\Carbon::parse($res->destination->start_date)->format('Y.m.d') }} - {{ \Illuminate\Support\Carbon::parse($res->destination->end_date)->format('Y.m.d') }}
                    @else
                      -
                    @endif
                  </td>
                    <td>{{ ucfirst($res->status) }}</td>
                    <td>{{ $res->created_at?->format('Y.m.d H:i') }}</td>
                    <td>
                      <form action="{{ route('reservations.destroy', $res) }}" method="POST" onsubmit="return confirm('Biztosan törli a foglalást?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Törlés</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <p>Még nincs foglalásod.</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
