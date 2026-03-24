<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = [
            [
                'title' => 'Észak-Olaszországi körút',
                'slug' => 'trip-olasz',
                'description' => 'Fedezze fel Észak-Olaszország varázsát! Velence csatornáitól a Dolomitok hegyeiig, ez a körút bemutatja a régió legjobb látnivalóit. Ízelítőt kap a velencei kultúrából, a milánói divatból és az alpesi tájak szépségéből.',
                'price_huf' => 156000,
                'start_date' => '2024-06-15',
                'end_date' => '2024-06-22',
                'image_path' => '/oldal/images/olasz.jpg',
                'image2_path' => '/oldal/images/olaszo.jpg',
                'detail_url' => '/trip/trip-olasz',
                'evszak' => 3, // Nyár
            ],
            [
                'title' => 'Mallorca szigete',
                'slug' => 'trip-mallorca',
                'description' => 'Spanyolország egyik leggyönyörűbb szigete várja! Tiszta tengerpartok, rejtett öblök, és a híres Serra de Tramuntana hegyvidék. Mallorca tökéletes kombinációja a relaxálásnak és a felfedezésnek.',
                'price_huf' => 190000,
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-08',
                'image_path' => '/oldal/images/mallorca.jpg',
                'image2_path' => '/oldal/images/mallorca2.jpg',
                'detail_url' => '/trip/trip-mallorca',
                'evszak' => 3, // Nyár
            ],
            [
                'title' => 'Norvégiai fjordok',
                'slug' => 'trip-norway',
                'description' => 'Észak-Európa lenyűgöző tájai! Norvégia fjordjai, északi fényei és a vikings történelme. Ez az utazás bemutatja Oslo, Bergen és a híres Geiranger fjord varázsát.',
                'price_huf' => 330000,
                'start_date' => '2024-08-10',
                'end_date' => '2024-08-17',
                'image_path' => '/oldal/images/norway.jpg',
                'image2_path' => '/oldal/images/norway2.jpg',
                'detail_url' => '/trip/trip-norway',
                'evszak' => 3, // Nyár
            ],
            [
                'title' => 'Prága és környéke',
                'slug' => 'trip-prague',
                'description' => 'Európa egyik legromantikusabb fővárosa! A prágai vár, a Károly híd és a régi város hangulata. Fedezze fel Csehország szívét és a közeli Karlštejn várat.',
                'price_huf' => 125000,
                'start_date' => '2024-05-20',
                'end_date' => '2024-05-25',
                'image_path' => '/oldal/images/praga.jpg',
                'image2_path' => '/oldal/images/praga2.jpeg',
                'detail_url' => '/trip/trip-prague',
                'evszak' => 2, // Tavasz
            ],
            [
                'title' => 'Lisszabon és a portugál riviéra',
                'slug' => 'trip-lisbon',
                'description' => 'Portugália fővárosa és a gyönyörű atlanti part! Lisszabon történelmi negyedei, a híres 25 ápríl híd és a közeli Cascais és Sintra települések.',
                'price_huf' => 175000,
                'start_date' => '2024-09-15',
                'end_date' => '2024-09-22',
                'image_path' => '/oldal/images/Lisbon.jpg',
                'image2_path' => '/oldal/images/lisbon2.webp',
                'detail_url' => '/trip/trip-lisbon',
                'evszak' => 4, // Ősz
            ],
            [
                'title' => 'Törökországi kaland',
                'slug' => 'trip-turkey',
                'description' => 'Isztambul és a török riviéra! Kelet és Nyugat találkozása, a Hagia Sophia, a Kék mecset és a boszporusz partjai. Fedezze fel Törökország gazdag kultúráját és gyönyörű tengerpartjait.',
                'price_huf' => 210000,
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-08',
                'image_path' => '/oldal/images/török.jpg',
                'image2_path' => '/oldal/images/töröko2.jpg',
                'detail_url' => '/trip/trip-turkey',
                'evszak' => 4, // Ősz
            ],
            [
                'title' => 'Ciprusi napfény',
                'slug' => 'trip-cyprus',
                'description' => 'Afrodité szigete! Ciprus gyönyörű tengerpartjai, hegyvidéke és történelmi látnivalói. Paphos, Limassol és a Troodos hegyvidék varázsa.',
                'price_huf' => 185000,
                'start_date' => '2024-06-01',
                'end_date' => '2024-06-08',
                'image_path' => '/oldal/images/ciprus.jpg',
                'image2_path' => '/oldal/images/ciprus2.jpg',
                'detail_url' => '/trip/trip-cyprus',
                'evszak' => 3, // Nyár
            ],
            [
                'title' => 'Izlandi tűz és jég',
                'slug' => 'trip-iceland',
                'description' => 'A tűz és jég országa! Izland gejzírjei, vízesései, vulkánjai és a híres északi fény. Reykjavík és a Golden Circle varázsa.',
                'price_huf' => 380000,
                'start_date' => '2024-07-15',
                'end_date' => '2024-07-22',
                'image_path' => '/oldal/images/izland.jpg',
                'image2_path' => '/oldal/images/izland2.jpg',
                'detail_url' => '/trip/trip-iceland',
                'evszak' => 3, // Nyár
            ],
            [
                'title' => 'Máltai történelem',
                'slug' => 'trip-malta',
                'description' => 'A lovagok szigete! Málta történelmi városai, a híres Blue Lagoon és a mediterrán hangulat. Valletta, Mdina és a Gozo sziget felfedezése.',
                'price_huf' => 165000,
                'start_date' => '2024-05-10',
                'end_date' => '2024-05-17',
                'image_path' => '/oldal/images/malta.jpg',
                'image2_path' => '/oldal/images/malta2.jpg',
                'detail_url' => '/trip/trip-malta',
                'evszak' => 2, // Tavasz
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::updateOrCreate(
                ['slug' => $destination['slug']],
                $destination
            );
        }
    }
}
