<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class TripDetailController extends Controller
{
    public function show(string $slug): View
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $reservedSpots = 0;
        if (Schema::hasTable('reservations')) {
            $query = Reservation::where('destination_id', $destination->id);
            if (Schema::hasColumn('reservations', 'people_count')) {
                $reservedSpots = (int) $query->sum('people_count');
            } else {
                $reservedSpots = (int) $query->count();
            }
        }
        $limit = null;
        // Support legacy Hungarian column name 'foglallimit' if it exists on the model
        if (array_key_exists('foglallimit', $destination->getAttributes())) {
            $limit = (int) $destination->getAttribute('foglallimit');
        } elseif (isset($destination->capacity)) {
            $limit = (int) $destination->capacity;
        }
        $isFull = $limit !== null && $limit > 0 && $reservedSpots >= $limit;

        return view('pages.trip-detail', [
            'destination' => $destination,
            'currentReservations' => $reservedSpots,
            'limit' => $limit,
            'isFull' => $isFull,
        ]);
    }
}
