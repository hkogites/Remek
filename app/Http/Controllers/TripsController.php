<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class TripsController extends Controller
{
    public function index(): View
    {
        $query = Destination::query();
        if (Schema::hasColumn('destination', 'start_date')) {
            $query->orderBy('start_date');
        } else {
            $query->orderBy('id');
        }
        $destinations = $query->get();

        // Group by season if available
        $seasonNames = [
            1 => 'Tél',
            2 => 'Tavasz',
            3 => 'Nyár',
            4 => 'Ősz',
        ];
        $groups = [];
        if (Schema::hasColumn('destination', 'evszak')) {
            // Ensure we have buckets for all four seasons in order
            foreach ([1,2,3,4] as $s) {
                $groups[$s] = $destinations->where('evszak', (int)$s)->values();
            }
        } else {
            // Fallback: put everything under 0 (no season)
            $groups[0] = $destinations;
            $seasonNames[0] = 'Egyéb';
        }

        return view('pages.trips', [
            'destinations' => $destinations,
            'groups' => $groups,
            'seasonNames' => $seasonNames,
        ]);
    }
}
