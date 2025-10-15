<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Facades\Schema;

class SeasonalDestinationsSeeder extends Seeder
{
    public function run(): void
    {
        // 1=Tél, 2=Tavasz, 3=Nyár, 4=Ősz
        $items = [
            // Tavasz (2)
            [
                'slug' => 'trip-japan-spring',
                'title' => 'Japán – Cseresznyevirágzás',
                'evszak' => 2,
                'price_huf' => 520000,
                'start_date' => '2026-03-28',
                'end_date' => '2026-04-05',
                'image_path' => '/oldal/images/japankor.jpg',
                'detail_url' => '/trip-japan-spring',
                'leiras' => 'Tavasszal Japán a hanami, a cseresznyevirágzás ünnepe miatt varázslatos. Kiotó, Tokió és Oszaka parkjai ünnepi hangulatban telnek meg, a kellemes tavaszi idő pedig ideális a kertek és történelmi városrészek felfedezéséhez. Az időszak népszerűsége miatt javasolt az időbeni foglalás.',
            ],
            [
                'slug' => 'trip-netherlands-spring',
                'title' => 'Hollandia – Tulipánok és Keukenhof',
                'evszak' => 2,
                'price_huf' => 240000,
                'start_date' => '2026-04-15',
                'end_date' => '2026-04-20',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-netherlands-spring',
                'leiras' => 'Hollandia tavasszal a tulipánok hazája. A világ egyik legnagyobb virágparkja, a Keukenhof színpompás látványt nyújt, Amszterdam csatornái és múzeumai pedig új életre kelnek. Friss, kellemes idő, biciklis városnézés és a Király Napja teszi emlékezetessé az évszakot.',
            ],
            [
                'slug' => 'trip-portugal-spring',
                'title' => 'Portugália – Lisszabon, Porto és Douro',
                'evszak' => 2,
                'price_huf' => 260000,
                'start_date' => '2026-05-10',
                'end_date' => '2026-05-15',
                'image_path' => '/oldal/images/Lisbon.jpg',
                'detail_url' => '/trip-portugal-spring',
                'leiras' => 'Portugáliában tavasszal enyhe, napos idő és virágzó táj fogad. Lisszabon és Porto bájos utcái ilyenkor különösen élvezetesek, a Douro-völgyben beindul a szőlőültetvények ébredése. Az Algarve partvidékén a tavasz végén már a strandolás is szóba jöhet.',
            ],
            [
                'slug' => 'trip-morocco-spring',
                'title' => 'Marokkó – Sivatagi kaland',
                'evszak' => 2,
                'price_huf' => 280000,
                'start_date' => '2026-03-18',
                'end_date' => '2026-03-24',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-morocco-spring',
                'leiras' => 'Marokkó tavasszal nappal kellemesen meleg, estére üdítően hűvös – tökéletes a sivatagi túrákhoz. Marrákes, Fez és Chefchaouen színes bazárjai kevésbé zsúfoltak, az Atlasz hegyeiben pedig kiváló túraútvonalak várnak.',
            ],

            // Nyár (3)
            [
                'slug' => 'trip-iceland-summer',
                'title' => 'Izland – Éjféli Nap és vízesések',
                'evszak' => 3,
                'price_huf' => 590000,
                'start_date' => '2026-06-18',
                'end_date' => '2026-06-25',
                'image_path' => '/oldal/images/izlandkor.jpg',
                'detail_url' => '/trip-iceland-summer',
                'leiras' => 'Izland nyáron a természet rajongóinak paradicsoma: a nap szinte alig nyugszik le, így jut idő vízesésekre, gejzírekre és vulkanikus tájakra. Husavík környékén bálnales, a Ring Road mentén pedig életre szóló autós túra vár.',
            ],
            [
                'slug' => 'trip-canada-summer',
                'title' => 'Kanada – Nemzeti parkok és városok',
                'evszak' => 3,
                'price_huf' => 620000,
                'start_date' => '2026-07-10',
                'end_date' => '2026-07-20',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-canada-summer',
                'leiras' => 'Kanada nyáron fesztiválokkal, kristálytiszta tavakkal és hatalmas hegyekkel csábít. A Sziklás-hegység túrái, Montreal és Quebec kulturális élményei, valamint a kempingezés és kajakozás a kanadai életérzés részei.',
            ],
            [
                'slug' => 'trip-greece-summer',
                'title' => 'Görögország – Szigetek és tenger',
                'evszak' => 3,
                'price_huf' => 220000,
                'start_date' => '2026-08-05',
                'end_date' => '2026-08-12',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-greece-summer',
                'leiras' => 'A görög szigetek a tengerparti pihenés Mekkái. Santorini és Mykonos ikonikus látképe, Kréta és Rodosz öblei, valamint a mediterrán konyha és naplementék felejthetetlenné teszik a nyarat.',
            ],
            [
                'slug' => 'trip-norway-summer',
                'title' => 'Norvégia – Fjordok és kalandok',
                'evszak' => 3,
                'price_huf' => 330000,
                'start_date' => '2026-07-22',
                'end_date' => '2026-07-28',
                'image_path' => '/oldal/images/norway.jpg',
                'detail_url' => '/trip-norway-summer',
                'leiras' => 'Norvégia nyáron fjordjaival, lélegzetelállító kilátóival és az éjféli nappal csábít. Túrázás, kajakozás és hajózás vár, a városok – például Bergen és Oslo – pedig nyüzsgő, mégis természetközeli élményt adnak.',
            ],

            // Ősz (4)
            [
                'slug' => 'trip-italy-autumn',
                'title' => 'Olaszország – Szüret és városok',
                'evszak' => 4,
                'price_huf' => 240000,
                'start_date' => '2026-10-02',
                'end_date' => '2026-10-07',
                'image_path' => '/oldal/images/italy.jpg',
                'detail_url' => '/trip-italy-autumn',
                'leiras' => 'Ősszel az olasz táj szüret illatával és meleg színeivel hívogat. Toszkánától Umbriáig borvacsorák, szarvasgombafesztiválok és nyugodtabb városnézés vár, a nagyvárosokban pedig enyhébb az idő és kevesebb a tömeg.',
            ],
            [
                'slug' => 'trip-japan-autumn',
                'title' => 'Japán – Őszi lombszíneződés',
                'evszak' => 4,
                'price_huf' => 520000,
                'start_date' => '2026-11-08',
                'end_date' => '2026-11-16',
                'image_path' => '/oldal/images/japankor.jpg',
                'detail_url' => '/trip-japan-autumn',
                'leiras' => 'Japán ősszel a momiji, a vörös-arany lombszíneződés miatt különleges. Kiotó és Nara templomkertjei, bambuszligetei és hegyvidéki ösvényei fotózásra és természetjárásra csábítanak, kellemes, száraz időben.',
            ],
            [
                'slug' => 'trip-usa-newengland-autumn',
                'title' => 'USA – Új-Anglia őszi tájak',
                'evszak' => 4,
                'price_huf' => 650000,
                'start_date' => '2026-10-10',
                'end_date' => '2026-10-18',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-usa-newengland-autumn',
                'leiras' => 'Új-Anglia (Vermont, Maine, Massachusetts) világhírű őszi színkavalkádja kisvárosi fesztiválokkal, farmokkal és autós kirándulásokkal párosul. A dombos táj és a régi fehér templomtornyok igazi képeslap-hangulatot adnak.',
            ],
            [
                'slug' => 'trip-france-autumn',
                'title' => 'Franciaország – Borvidékek és városok',
                'evszak' => 4,
                'price_huf' => 270000,
                'start_date' => '2026-09-20',
                'end_date' => '2026-09-25',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-france-autumn',
                'leiras' => 'Franciaország ősszel a borvidékek szüretével, szezonális gasztronómiával és romantikus városnézéssel csábít. Párizs lágy fényei és a csendes vidéki tájak békés, inspiráló hangulatot nyújtanak.',
            ],

            // Tél (1)
            [
                'slug' => 'trip-austria-winter',
                'title' => 'Ausztria – Síbirodalom és advent',
                'evszak' => 1,
                'price_huf' => 180000,
                'start_date' => '2026-12-15',
                'end_date' => '2026-12-20',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-austria-winter',
                'leiras' => 'Ausztria télen a síelők és az adventi vásárok rajongóit várja. Tirol és Salzburg síparadicsomai mellett Bécs és Graz ünnepi fényei, forralt borai és zenei programjai varázslatos hangulatot teremtenek.',
            ],
            [
                'slug' => 'trip-finland-winter',
                'title' => 'Finnország – Lappföld és sarki fény',
                'evszak' => 1,
                'price_huf' => 540000,
                'start_date' => '2027-01-18',
                'end_date' => '2027-01-24',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-finland-winter',
                'leiras' => 'Finnországban a hóval borított tájak, a Mikulásfalva és a sarki fény teszi különlegessé a telet. Motoros szán, husky túrák, jéghalászat és szaunázás vár – mindez az északi égbolton táncoló aurora kíséretében.',
            ],
            [
                'slug' => 'trip-thailand-winter',
                'title' => 'Thaiföld – Trópusi feltöltődés',
                'evszak' => 1,
                'price_huf' => 390000,
                'start_date' => '2027-02-04',
                'end_date' => '2027-02-12',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-thailand-winter',
                'leiras' => 'Thaiföld a télből a nyárba vezet: száraz, napos, meleg idő, csodás szigetek és gazdag kultúra. Bangkok, Chiang Mai és a déli tengerpartok változatos programokat kínálnak a pihenéstől az aktív kalandokig.',
            ],
            [
                'slug' => 'trip-chile-winter',
                'title' => 'Chile – Patagónia és borvidékek',
                'evszak' => 1,
                'price_huf' => 680000,
                'start_date' => '2027-01-22',
                'end_date' => '2027-01-31',
                'image_path' => '/oldal/images/hegy.jpg',
                'detail_url' => '/trip-chile-winter',
                'leiras' => 'Chilében ilyenkor nyár van: Patagónia gleccserei és hegyvidékei könnyen bejárhatók, Santiago és a közeli borvidékek pedig kiváló gasztronómiát kínálnak. A csendes-óceáni part mentén pihenés és kirándulás vár.',
            ],
        ];

        $hasLegacyName = Schema::hasColumn('destination', 'name');
        $hasLegacyAr = Schema::hasColumn('destination', 'ar');
        $hasFoglallimit = Schema::hasColumn('destination', 'foglallimit');

        foreach ($items as $item) {
            $data = $item;
            // Ensure required non-null fields exist on legacy schemas
            if (!array_key_exists('leiras', $data)) {
                $data['leiras'] = '';
            }
            if ($hasLegacyName) {
                $data['name'] = $item['title'];
            }
            if ($hasLegacyAr) {
                $data['ar'] = $item['price_huf'];
            }
            if ($hasFoglallimit && !array_key_exists('foglallimit', $data)) {
                // Randomize capacity between 5 and 30 with increments of 2 and/or 5
                $choices = [5,6,8,10,12,14,15,16,18,20,22,24,25,26,28,30];
                $data['foglallimit'] = $choices[array_rand($choices)];
            }
            Destination::updateOrCreate(
                ['slug' => $item['slug']],
                $data
            );
        }
    }
}
