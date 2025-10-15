<?php

namespace App\Http\Controllers;

use App\Models\Destination;
<<<<<<< HEAD
=======
use Illuminate\Http\Request;
>>>>>>> 402e2fc82c5bcf1443789af573a3376b720a2836
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class TripsController extends Controller
{
<<<<<<< HEAD
    public function index(): View
    {
        $query = Destination::query();
=======
    public function index(Request $request): View
    {
        $selectedSeason = null;
        $seasonParam = $request->query('season');
        if (in_array((int)$seasonParam, [1,2,3,4], true)) {
            $selectedSeason = (int)$seasonParam;
        }
        $query = Destination::query();
        if ($selectedSeason !== null && Schema::hasColumn('destination', 'evszak')) {
            $query->where('evszak', $selectedSeason);
        }
>>>>>>> 402e2fc82c5bcf1443789af573a3376b720a2836
        if (Schema::hasColumn('destination', 'start_date')) {
            $query->orderBy('start_date');
        } else {
            $query->orderBy('id');
        }
        $destinations = $query->get();
<<<<<<< HEAD
        return view('pages.trips', compact('destinations'));
=======

        $seasonNames = [
            1 => 'Tél',
            2 => 'Tavasz',
            3 => 'Nyár',
            4 => 'Ősz',
        ];
        return view('pages.trips', [
            'destinations' => $destinations,
            'seasonNames' => $seasonNames,
            'selectedSeason' => $selectedSeason,
        ]);
>>>>>>> 402e2fc82c5bcf1443789af573a3376b720a2836
    }
}
