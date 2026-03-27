<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        // Show the same "top" destinations as the /trips page (default: no season filter).
        // This way, any DB updates are reflected automatically on next page load.
        $query = Destination::query();
        if (Schema::hasColumn('destination', 'start_date')) {
            $query->orderBy('start_date');
        } else {
            $query->orderBy('id');
        }

        $topDestinations = $query->limit(3)->get();

        return view('pages.index', compact('topDestinations'));
    }
}

