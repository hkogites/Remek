<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class SeasonalDestinationsSeeder extends Seeder
{
    public function run()
    {
        // Téli úti célok
        $winter_destinations = [
            [
                'name' => 'Norvégiai téli varázslat',
                'title' => 'Norvégiai téli varázslat',
                'slug' => 'norway-winter',
                'ar' => 380000,
                'leiras' => 'Fedezze fel Norvégia téli szépségét! A sarki fény, a hófödte fjordok és a hagyományos vikings falvak.',
                'description' => 'Fedezze fel Norvégia téli szépségét! A sarki fény, a hófödte fjordok és a hagyományos vikings falvak. Ez a téli kaland bemutatja Oslo, Bergen és a híres Tromső varázsát.',
                'price_huf' => 380000,
                'foglallimit' => 20,
                'start_date' => '2024-12-15',
                'end_date' => '2024-12-22',
                'image_path' => '/oldal/images/norway.jpg',
                'image2_path' => '/oldal/images/norway2.jpg',
                'detail_url' => '/trip/norway-winter',
                'evszak' => 1,
            ],
            [
                'name' => 'Izlandi tűz és jég',
                'title' => 'Izlandi tűz és jég',
                'slug' => 'iceland-winter',
                'ar' => 420000,
                'leiras' => 'A tűz és jég országa télen! Izland gejzírjei, jégbarlangjai, vulkánjai és a híres északi fény.',
                'description' => 'A tűz és jég országa télen! Izland gejzírjei, jégbarlangjai, vulkánjai és a híres északi fény. Reykjavík és a Golden Circle téli varázsa.',
                'price_huf' => 420000,
                'foglallimit' => 15,
                'start_date' => '2025-01-10',
                'end_date' => '2025-01-17',
                'image_path' => '/oldal/images/izland.jpg',
                'image2_path' => '/oldal/images/izland2.jpg',
                'detail_url' => '/trip/iceland-winter',
                'evszak' => 1,
            ],
            [
                'name' => 'Ausztriai síparadicsom',
                'title' => 'Ausztriai síparadicsom',
                'slug' => 'austria-ski',
                'ar' => 280000,
                'leiras' => 'Ausztria legjobb síterepei! A Tirol hegyvidék, Innsbruck és Salzburg környéke.',
                'description' => 'Ausztria legjobb síterepei! A Tirol hegyvidék, Innsbruck és Salzburg környéke. Téli sportok, fürdők és a híres osztrák konyha.',
                'price_huf' => 280000,
                'foglallimit' => 25,
                'start_date' => '2025-01-20',
                'end_date' => '2025-01-27',
                'image_path' => '/oldal/images/austria.jpg',
                'image2_path' => '/oldal/images/austria2.webp',
                'detail_url' => '/trip/austria-ski',
                'evszak' => 1,
            ],
        ];

        // Tavaszi úti célok
        $spring_destinations = [
            [
                'name' => 'Hollandiai tulipánok',
                'title' => 'Hollandiai tulipánok',
                'slug' => 'netherlands-tulips',
                'ar' => 165000,
                'leiras' => 'Hollandia tavaszi szépsége! A Keukenhof kert, a híres tulipánmezők és Amszterdam csatornái.',
                'description' => 'Hollandia tavaszi szépsége! A Keukenhof kert, a híres tulipánmezők és Amszterdam csatornái. Fedezze fel a holland virágkultúrát és a történelmi városokat.',
                'price_huf' => 165000,
                'foglallimit' => 30,
                'start_date' => '2025-04-15',
                'end_date' => '2025-04-22',
                'image_path' => '/oldal/images/netherlands.jpg',
                'image2_path' => '/oldal/images/Netherlands2.jpg',
                'detail_url' => '/trip/netherlands-tulips',
                'evszak' => 2,
            ],
            [
                'name' => 'Prága és környéke',
                'title' => 'Prága és környéke',
                'slug' => 'prague-spring',
                'ar' => 125000,
                'leiras' => 'Európa egyik legromantikusabb fővárosa tavasszal! A prágai vár, a Károly híd és a régi város hangulata.',
                'description' => 'Európa egyik legromantikusabb fővárosa tavasszal! A prágai vár, a Károly híd és a régi város hangulata. Fedezze fel Csehország szívét és a közeli Karlštejn várat.',
                'price_huf' => 125000,
                'foglallimit' => 40,
                'start_date' => '2025-05-20',
                'end_date' => '2025-05-25',
                'image_path' => '/oldal/images/praga.jpg',
                'image2_path' => '/oldal/images/praga2.jpeg',
                'detail_url' => '/trip/prague-spring',
                'evszak' => 2,
            ],
            [
                'name' => 'Máltai történelem',
                'title' => 'Máltai történelem',
                'slug' => 'malta-spring',
                'ar' => 165000,
                'leiras' => 'A lovagok szigete tavasszal! Málta történelmi városai, a híres Blue Lagoon és a mediterrán hangulat.',
                'description' => 'A lovagok szigete tavasszal! Málta történelmi városai, a híres Blue Lagoon és a mediterrán hangulat. Valletta, Mdina és a Gozo sziget felfedezése.',
                'price_huf' => 165000,
                'foglallimit' => 35,
                'start_date' => '2025-05-10',
                'end_date' => '2025-05-17',
                'image_path' => '/oldal/images/malta.jpg',
                'image2_path' => '/oldal/images/malta2.jpg',
                'detail_url' => '/trip/malta-spring',
                'evszak' => 2,
            ],
        ];

        // Nyári úti célok
        $summer_destinations = [
            [
                'name' => 'Görög szigetvilág',
                'title' => 'Görög szigetvilág',
                'slug' => 'greece-islands',
                'ar' => 220000,
                'leiras' => 'Görögország leggyönyörűbb szigetei! Santorini, Mykonos és a híres Kréta.',
                'description' => 'Görögország leggyönyörűbb szigetei! Santorini, Mykonos és a híres Kréta. Tiszta tengerpartok, fehér házak és a mediterrán konyha.',
                'price_huf' => 220000,
                'foglallimit' => 25,
                'start_date' => '2025-06-15',
                'end_date' => '2025-06-22',
                'image_path' => '/oldal/images/greece.jpg',
                'image2_path' => '/oldal/images/greece2.jpg',
                'detail_url' => '/trip/greece-islands',
                'evszak' => 3,
            ],
            [
                'name' => 'Spanyol riviéra',
                'title' => 'Spanyol riviéra',
                'slug' => 'spain-riviera',
                'ar' => 245000,
                'leiras' => 'Spanyolország napsütötte partjai! Costa Brava, Costa del Sol és a híres Barcelona.',
                'description' => 'Spanyolország napsütötte partjai! Costa Brava, Costa del Sol és a híres Barcelona. Tapas kultúra, flamenco és a mediterrán életérzés.',
                'price_huf' => 245000,
                'foglallimit' => 30,
                'start_date' => '2025-07-01',
                'end_date' => '2025-07-08',
                'image_path' => '/oldal/images/spain.jpg',
                'image2_path' => '/oldal/images/spain2.jpg',
                'detail_url' => '/trip/spain-riviera',
                'evszak' => 3,
            ],
            [
                'name' => 'Olasz tengerpart',
                'title' => 'Olasz tengerpart',
                'slug' => 'italy-coast',
                'ar' => 265000,
                'leiras' => 'Olaszország legjobb tengerpartjai! Amalfi part, Cinque Terre és a szicíliai szépségek.',
                'description' => 'Olaszország legjobb tengerpartjai! Amalfi part, Cinque Terre és a szicíliai szépségek. Pizza, pasta és a dolce vita élménye.',
                'price_huf' => 265000,
                'foglallimit' => 20,
                'start_date' => '2025-08-10',
                'end_date' => '2025-08-17',
                'image_path' => '/oldal/images/italy.jpg',
                'image2_path' => '/oldal/images/italy2.jpg',
                'detail_url' => '/trip/italy-coast',
                'evszak' => 3,
            ],
        ];

        // őszi úti célok
        $autumn_destinations = [
            [
                'name' => 'Törökországi ősz',
                'title' => 'Törökországi ősz',
                'slug' => 'turkey-autumn',
                'ar' => 195000,
                'leiras' => 'Törökország őszben! Isztambul és a török riviéra. Kelet és Nyugat találkozása.',
                'description' => 'Törökország őszben! Isztambul és a török riviéra. Kelet és Nyugat találkozása, a Hagia Sophia, a Kék mecset és a boszporusz partjai.',
                'price_huf' => 195000,
                'foglallimit' => 25,
                'start_date' => '2025-10-01',
                'end_date' => '2025-10-08',
                'image_path' => '/oldal/images/turkey.jpg',
                'image2_path' => '/oldal/images/turkey2.jpg',
                'detail_url' => '/trip/turkey-autumn',
                'evszak' => 4,
            ],
            [
                'name' => 'Francia borvidékek',
                'title' => 'Francia borvidékek',
                'slug' => 'france-wine',
                'ar' => 285000,
                'leiras' => 'Franciaország híres borvidékei ősszel! Bordeaux, Burgundia és Champagne.',
                'description' => 'Franciaország híres borvidékei ősszel! Bordeaux, Burgundia és Champagne. Szüret, kastélyok és a francia gasztronómia.',
                'price_huf' => 285000,
                'foglallimit' => 20,
                'start_date' => '2025-09-15',
                'end_date' => '2025-09-22',
                'image_path' => '/oldal/images/france.jpg',
                'image2_path' => '/oldal/images/france2.jpg',
                'detail_url' => '/trip/france-wine',
                'evszak' => 4,
            ],
            [
                'name' => 'Kanadai őszi színek',
                'title' => 'Kanadai őszi színek',
                'slug' => 'canada-fall',
                'ar' => 355000,
                'leiras' => 'Kanada lenyűgöző őszi színei! Québec, Ontario és a híres Maple syrup.',
                'description' => 'Kanada lenyűgöző őszi színei! Québec, Ontario és a híres Maple syrup. Erdők, tavak és a kanadai vadon.',
                'price_huf' => 355000,
                'foglallimit' => 15,
                'start_date' => '2025-10-15',
                'end_date' => '2025-10-22',
                'image_path' => '/oldal/images/canada.jpg',
                'image2_path' => '/oldal/images/canada2.jpg',
                'detail_url' => '/trip/canada-fall',
                'evszak' => 4,
            ],
        ];

        // Összes úti cél egyesítése
        $all_destinations = array_merge($winter_destinations, $spring_destinations, $summer_destinations, $autumn_destinations);

        foreach ($all_destinations as $destination) {
            Destination::updateOrCreate(
                ['slug' => $destination['slug']],
                $destination
            );
        }
    }
}
