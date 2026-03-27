<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Destination;

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

        // Destination key -> fallback display text (used if DB mapping/record is missing).
        // Keeping this ensures the page won't break even if a specific quiz key
        // doesn't have a corresponding destination row in the database.
        $fallbackNames = [
            'prague' => 'Prága',
            'paris' => 'Párizs',
            'rome' => 'Róma',
            'amsterdam' => 'Amszterdam',
            'barcelona' => 'Barcelona',
            'lisbon' => 'Lisszabon',
            'vienna' => 'Bécs',
            'budapest' => 'Budapest',
            'prague_castle' => 'Prágai Vár',
            'eiffel_tower' => 'Eiffel-torony',
            'colosseum' => 'Colosseum',
            'sagrada_familia' => 'Sagrada Família',
            'anne_frank_house' => 'Anne Frank Ház',
            'belem_tower' => 'Belémi torony',
            'schonbrunn_palace' => 'Schönbrunn Palota',
            'parliament_hungary' => 'Parlament'
        ];

        $fallbackDescriptions = [
            'prague' => 'Európa egyik legromantikusabb fővárosa, lenyűgöző építészettel és történelemmel.',
            'paris' => 'Az a szerelem és a művészet városa, ikonikus látnivalókkal és romantikus hangulattal.',
            'rome' => 'Az örök város, ahol minden sarkon történelem és kultúra vár.',
            'amsterdam' => 'Művészeti galériák, csatornák és modern, laza hangulat.',
            'barcelona' => 'Tengerpart, modern építészet és gazdag kulturális élet.',
            'lisbon' => 'Történelmi negyedek, hagyományos konyha és mediterrán hangulat.',
            'vienna' => 'Kulturális központ, kávéházak és császári paloták.',
            'budapest' => 'Történelmi fürdők, impozáns épületek és megfizethető árak.',
            'prague_castle' => 'Prága szíve, történelmi jelentőségű várkomplexum.',
            'eiffel_tower' => 'Párizs ikonikus szimbóluma, lenyűgöző kilátással.',
            'colosseum' => 'Róma ősi amfiteátruma, a római birodalom jelképe.',
            'sagrada_familia' => 'Gaudi mesterműve, Barcelona egyik leglátogatottabb helye.',
            'anne_frank_house' => 'Mozgató történelmi élmény Amszterdam szívében.',
            'belem_tower' => 'Lisszabon történelmi jelképe, a tengeri felfedezések emléke.',
            'schonbrunn_palace' => 'Bécs császári palotája, kertekkel és gazdag történelemmel.',
            'parliament_hungary' => 'Budapest ikonikus épülete, a magyar parlament székhelye.'
        ];

        $quizKeyToDestinationSlug = [
            'prague' => 'trip-prague',
            'paris' => 'trip-france-autumn',
            'rome' => 'trip-olasz',
            'amsterdam' => 'trip-netherlands-spring',
            'barcelona' => 'trip-mallorca',
            'lisbon' => 'trip-lisbon',
            'vienna' => 'trip-austria-winter',
            'budapest' => 'trip-prague',

            // Landmark/variant keys map to the same base destination packages.
            'prague_castle' => 'trip-prague',
            'eiffel_tower' => 'trip-france-autumn',
            'colosseum' => 'trip-olasz',
            'sagrada_familia' => 'trip-mallorca',
            'anne_frank_house' => 'trip-netherlands-spring',
            'belem_tower' => 'trip-lisbon',
            'schonbrunn_palace' => 'trip-austria-winter',
            'parliament_hungary' => 'trip-prague',
        ];

        $topDestinationsDetails = [];
        foreach ($topDestinations as $destinationKey => $score) {
            $slug = $quizKeyToDestinationSlug[$destinationKey] ?? null;
            $destination = $slug ? Destination::where('slug', $slug)->first() : null;

            $detailUrl = null;
            if ($destination) {
                $title = $destination->title ?? ($fallbackNames[$destinationKey] ?? $destinationKey);
                $leirasPlain = trim(strip_tags((string) ($destination->leiras ?? '')));
                $description = $leirasPlain !== ''
                    ? Str::limit($leirasPlain, 200)
                    : ($fallbackDescriptions[$destinationKey] ?? '');
                // Use the app route format consistently:
                // /trip/{slug}, where slug is the destination.slug (e.g. "trip-france-autumn").
                // This avoids mismatches where DB detail_url is something like "/trip-france-autumn".
                $detailUrl = '/trip/' . $destination->slug;
            } else {
                $title = $fallbackNames[$destinationKey] ?? $destinationKey;
                $description = $fallbackDescriptions[$destinationKey] ?? '';
                $detailUrl = $slug ? ('/trip/' . $slug) : null;
            }

            $topDestinationsDetails[$destinationKey] = [
                'score' => $score,
                'title' => $title,
                'description' => $description,
                'detail_url' => $detailUrl,
            ];
        }

        return [
            'top_destinations' => $topDestinationsDetails,
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
