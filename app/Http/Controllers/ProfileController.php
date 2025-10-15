<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Reservation;

class ProfileController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();
        $reservations = Reservation::with('destination')
            ->where('user_id', $user->id)
            ->latest()
            ->get();
        return view('pages.profile', compact('user', 'reservations'));
    }
}
