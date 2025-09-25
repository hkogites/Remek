<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    public function create(string $slug): View|RedirectResponse
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        // Compute capacity (sum of people if column exists)
        $currentReserved = Reservation::where('destination_id', $destination->id)
            ->when(\Schema::hasColumn('reservations', 'people_count'), function ($q) {
                // sum people_count if available
                // no-op here; we will sum after the query
            })
            ->get();
        $reservedSpots = \Schema::hasColumn('reservations', 'people_count')
            ? (int) $currentReserved->sum('people_count')
            : (int) $currentReserved->count();

        $limit = null;
        if (array_key_exists('foglallimit', $destination->getAttributes())) {
            $limit = (int) $destination->getAttribute('foglallimit');
        } elseif (isset($destination->capacity)) {
            $limit = (int) $destination->capacity;
        }
        $isFull = $limit !== null && $limit > 0 && $reservedSpots >= $limit;
        if ($isFull) {
            return redirect()->route('trip.show', $slug)->with('status', 'Sajnos ez az út betelt.');
        }
        $user = Auth::user();
        return view('reservations.create', [
            'destination' => $destination,
            'user' => $user,
            'currentReservations' => $reservedSpots,
            'limit' => $limit,
        ]);
    }

    public function store(Request $request, string $slug): RedirectResponse
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        // Re-check capacity at submit time
        $currentReserved = Reservation::where('destination_id', $destination->id)->get();
        $reservedSpots = \Schema::hasColumn('reservations', 'people_count')
            ? (int) $currentReserved->sum('people_count')
            : (int) $currentReserved->count();
        $limit = null;
        if (array_key_exists('foglallimit', $destination->getAttributes())) {
            $limit = (int) $destination->getAttribute('foglallimit');
        } elseif (isset($destination->capacity)) {
            $limit = (int) $destination->capacity;
        }
        $isFull = $limit !== null && $limit > 0 && $reservedSpots >= $limit;
        if ($isFull) {
            return redirect()->route('trip.show', $slug)->with('status', 'Sajnos ez az út betelt.');
        }

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'people_count' => ['required', 'integer', 'min:1', 'max:20'],
            'note' => ['nullable', 'string', 'max:2000'],
        ]);
        $data['user_id'] = Auth::id();
        $data['destination_id'] = $destination->id;
        $data['status'] = 'pending';
        $data['address'] = $request->input('address');
        $data['people_count'] = $request->input('people_count');
        // Final capacity check including this request
        $willBe = $reservedSpots + (int) $data['people_count'];
        if ($limit !== null && $limit > 0 && $willBe > $limit) {
            return redirect()->back()->withInput()->with('status', 'Sajnos nincs elég szabad hely erre a létszámra. Elérhető helyek: '.max(0, $limit - $reservedSpots));
        }
        
        Reservation::create($data);

        return redirect()->route('profile')->with('status', 'Foglalás rögzítve. Hamarosan felvesszük Önnel a kapcsolatot.');
    }

    public function destroy(Reservation $reservation): RedirectResponse
    {
        // Allow only the owner to delete
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }
        $reservation->delete();
        return redirect()->route('profile')->with('status', 'Foglalás törölve.');
    }
}
