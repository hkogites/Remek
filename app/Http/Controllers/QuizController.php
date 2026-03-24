<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function show()
    {
        return view('pages.quiz');
    }

    public function submit(Request $request)
    {
        $answers = $request->all();
        
        // Remove CSRF token from answers
        unset($answers['_token']);
        
        // Store answers in session
        Session::put('quiz_answers', $answers);
        
        // Calculate results
        $results = $this->calculateResults($answers);
        
        // Store results in session
        Session::put('quiz_results', $results);
        
        return redirect()->route('quiz.result');
    }

    public function result()
    {
        $results = Session::get('quiz_results');
        $answers = Session::get('quiz_answers');
        
        if (!$results) {
            return redirect()->route('quiz.show');
        }
        
        return view('pages.quiz-result', compact('results', 'answers'));
    }

    private function calculateResults($answers)
    {
        $destinations = [
            'prague' => ['romantic', 'historic', 'cultural'],
            'paris' => ['romantic', 'artistic', 'cultural'],
            'rome' => ['historic', 'cultural', 'romantic'],
            'amsterdam' => ['artistic', 'modern', 'relaxed'],
            'barcelona' => ['beach', 'cultural', 'modern'],
            'lisbon' => ['historic', 'cultural', 'relaxed'],
            'vienna' => ['cultural', 'historic', 'romantic'],
            'budapest' => ['historic', 'cultural', 'affordable'],
            'prague_castle' => ['historic', 'romantic', 'cultural'],
            'eiffel_tower' => ['romantic', 'iconic', 'cultural'],
            'colosseum' => ['historic', 'iconic', 'cultural'],
            'sagrada_familia' => ['artistic', 'modern', 'cultural'],
            'anne_frank_house' => ['historic', 'cultural', 'moving'],
            'belem_tower' => ['historic', 'cultural', 'maritime'],
            'schonbrunn_palace' => ['historic', 'romantic', 'cultural'],
            'parliament_hungary' => ['historic', 'iconic', 'political'],
        ];

        $scores = [];
        
        foreach ($destinations as $destination => $traits) {
            $score = 0;
            
            foreach ($traits as $trait) {
                if (isset($answers[$trait])) {
                    $score += $answers[$trait];
                }
            }
            
            $scores[$destination] = $score;
        }
        
        // Sort by score
        arsort($scores);
        
        // Get top 3 destinations
        $topDestinations = array_slice($scores, 0, 3, true);
        
        // Determine personality type based on answers
        $personality = $this->determinePersonality($answers);
        
        return [
            'top_destinations' => $topDestinations,
            'personality' => $personality,
            'all_scores' => $scores
        ];
    }

    private function determinePersonality($answers)
    {
        $traits = [
            'adventurous' => $answers['adventurous'] ?? 0,
            'romantic' => $answers['romantic'] ?? 0,
            'cultural' => $answers['cultural'] ?? 0,
            'relaxed' => $answers['relaxed'] ?? 0,
            'historic' => $answers['historic'] ?? 0,
            'modern' => $answers['modern'] ?? 0,
            'artistic' => $answers['artistic'] ?? 0,
            'beach' => $answers['beach'] ?? 0,
        ];

        arsort($traits);
        $topTrait = array_key_first($traits);
        
        $personalities = [
            'adventurous' => 'Felfedező',
            'romantic' => 'Romantikus',
            'cultural' => 'Kulturális',
            'relaxed' => 'Lazító',
            'historic' => 'Történelmi',
            'modern' => 'Modern',
            'artistic' => 'Művészi',
            'beach' => 'Tengerparti',
        ];

        return $personalities[$topTrait] ?? 'Utazó';
    }
}
