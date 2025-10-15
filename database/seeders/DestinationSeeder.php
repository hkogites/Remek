<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Facades\Schema;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'slug' => 'trip-olasz',
                'title' => 'Észak-Olaszországi körút',
                'price_huf' => 156000,
                'start_date' => '2026-06-20',
                'end_date' => '2026-06-26',
                'image_path' => '/oldal/images/italy.jpg',
                'detail_url' => '/trip-olasz',
            ],
            [
                'slug' => 'trip-mallorca',
                'title' => 'Mallorca',
                'price_huf' => 190000,
                'start_date' => '2026-04-03',
                'end_date' => '2026-04-08',
                'image_path' => '/oldal/images/mallorca2.jpg',
                'detail_url' => '/trip-mallorca',
            ],
            [
                'slug' => 'trip-norway',
                'title' => 'Norvégia',
                'price_huf' => 330000,
                'start_date' => '2026-12-22',
                'end_date' => '2026-12-27',
                'image_path' => '/oldal/images/norway.jpg',
                'detail_url' => '/trip-norway',
            ],
            [
                'slug' => 'trip-turkey',
                'title' => 'Törökország',
                'price_huf' => 170000,
                'start_date' => '2026-03-03',
                'end_date' => '2026-03-09',
                'image_path' => '/oldal/images/Töröko.jpg',
                'detail_url' => '/trip-turkey',
            ],
            [
                'slug' => 'trip-prague',
                'title' => 'Prága',
                'price_huf' => 75000,
                'start_date' => '2026-10-23',
                'end_date' => '2026-10-25',
                'image_path' => '/oldal/images/praga.jpg',
                'detail_url' => '/trip-prague',
            ],
            [
                'slug' => 'trip-lisbon',
                'title' => 'Lisszabon',
                'price_huf' => 250000,
                'start_date' => '2026-09-01',
                'end_date' => '2026-09-06',
                'image_path' => '/oldal/images/Lisbon.jpg',
                'detail_url' => '/trip-lisbon',
            ],
        ];

        $hasName = Schema::hasColumn('destination', 'name');
        $hasAr = Schema::hasColumn('destination', 'ar');
        foreach ($items as $item) {
            $data = $item;
            if ($hasName) {
                // Populate legacy required column 'name' from title
                $data['name'] = $item['title'];
            }
            if ($hasAr) {
                // Populate legacy required column 'ar' (price)
                $data['ar'] = $item['price_huf'];
            }
            Destination::updateOrCreate(
                ['slug' => $item['slug']],
                $data
            );
        }
    }
}
