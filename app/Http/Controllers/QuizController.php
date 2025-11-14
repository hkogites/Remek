<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class QuizController extends Controller
{
    public function show()
    {
        return view('pages.quiz');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'answers' => ['required','array'],
        ]);

        $answers = $data['answers'];

        // Basic inference from quiz
        $preferredSeason = (int)($answers[2] ?? 0); // 1..4 map directly to evszak

        // Budget bands from Q4
        $budget = (int)($answers[4] ?? 0);
        $priceMin = null; $priceMax = null;
        if ($budget === 1) { $priceMax = 100_000; }
        elseif ($budget === 2) { $priceMin = 100_000; $priceMax = 200_000; }
        elseif ($budget === 3) { $priceMin = 200_000; $priceMax = 300_000; }
        elseif ($budget === 4) { $priceMin = 300_000; }

        $query = Destination::query();
        if ($preferredSeason >= 1 && $preferredSeason <= 4) {
            $query->where('evszak', $preferredSeason);
        }
        if ($priceMin !== null) {
            $query->where('price_huf', '>=', $priceMin);
        }
        if ($priceMax !== null) {
            $query->where('price_huf', '<=', $priceMax);
        }

        $destination = $query->orderBy('price_huf')->first();
        if (!$destination) {
            // Fallbacks
            $destination = Destination::when($preferredSeason, fn($q)=>$q->where('evszak', $preferredSeason))
                ->orderBy('price_huf')
                ->first();
        }
        if (!$destination) {
            $destination = Destination::orderBy('price_huf')->first();
        }

        $resultType = [
            'title' => 'Ajánlásod elkészült! 🎯',
            'description' => 'A válaszaid alapján ezt az utazást ajánljuk neked.',
        ];

        return view('pages.quiz-result', compact('destination', 'resultType'));
    }
}






