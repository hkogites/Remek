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
        return view('pages.trips', compact('destinations'));
    }
}
