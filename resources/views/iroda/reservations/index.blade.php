@extends('layouts.base')

@section('title', 'Iroda – Foglalások')

@section('body')
<div class="site-section py-5">
    <div class="container">
        @if(session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Foglalások</h1>
                <div class="text-muted">Iroda felület · összesen: {{ $reservations->total() }}</div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:20%">Név</th>
                                <th style="width:25%">Email</th>
                                <th style="width:15%">Úti cél</th>
                                <th style="width:10%">Állapot</th>
                                <th style="width:10%">Email</th>
                                <th style="width:10%">Létrehozva</th>
                                <th style="width:10%" class="text-end">Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $reservation)
                            <tr>
                                <td class="fw-semibold">{{ $reservation->full_name }}</td>
                                <td>{{ $reservation->email }}</td>
                                <td>
                                    @if($reservation->destination)
                                        <a href="{{ route('trip.show', $reservation->destination->slug) }}" target="_blank">
                                            {{ $reservation->destination->title }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $reservation->status }}">
                                        {{ $reservation->status === 'pending' ? 'Függőben' : ($reservation->status === 'confirmed' ? 'Megerősítve' : 'Törölve') }}
                                    </span>
                                </td>
                                <td>
                                    @if($reservation->email_sent)
                                        <span class="text-success">✓</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $reservation->created_at->format('Y.m.d H:i') }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('iroda.reservations.edit', $reservation) }}">Szerkesztés</a>
                                        <a class="btn btn-sm btn-outline-info" href="{{ route('iroda.reservations.send-email', $reservation) }}">Email</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">Nincs még foglalás.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($reservations->hasPages())
            <div class="mt-3 d-flex justify-content-between align-items-center small text-muted">
                <div>Oldal {{ $reservations->currentPage() }} / {{ $reservations->lastPage() }}</div>
                <div>
                    @if ($reservations->previousPageUrl())
                        <a class="text-decoration-none me-3" href="{{ $reservations->previousPageUrl() }}">&larr; Előző</a>
                    @else
                        <span class="me-3">&larr; Előző</span>
                    @endif
                    @if ($reservations->nextPageUrl())
                        <a class="text-decoration-none" href="{{ $reservations->nextPageUrl() }}">Következő &rarr;</a>
                    @else
                        <span>Következő &rarr;</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.badge-pending { background-color: #ffc107; color: #856404; }
.badge-confirmed { background-color: #28a745; color: white; }
.badge-cancelled { background-color: #dc3545; color: white; }
</style>
@endsection

@section('footer')
@endsection
