<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DescriptionImportSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'trip-olasz' => base_path('descriptionFromHere/trip-olasz.blade.php'),
            'trip-mallorca' => base_path('descriptionFromHere/trip-mallorca.blade.php'),
            'trip-norway' => base_path('descriptionFromHere/trip-norway.blade.php'),
            'trip-turkey' => base_path('descriptionFromHere/trip-turkey.blade.php'),
            'trip-prague' => base_path('descriptionFromHere/trip-prague.blade.php'),
            'trip-lisbon' => base_path('descriptionFromHere/trip-lisbon.blade.php'),
        ];

        foreach ($map as $slug => $path) {
            if (!is_file($path)) {
                $this->command?->warn("Missing description file for {$slug}: {$path}");
                continue;
            }
            $html = file_get_contents($path);
            if ($html === false) {
                $this->command?->warn("Could not read file: {$path}");
                continue;
            }
            // Extract the main content section between the first site-section and the footer
            $startPos = stripos($html, '<div class="site-section"');
            $footerPos = stripos($html, '<footer');
            if ($startPos === false || $footerPos === false || $footerPos <= $startPos) {
                // Fallback: store the whole file content (escaped by consumer via {!! !!} so keep as-is)
                $content = $html;
            } else {
                $content = substr($html, $startPos, $footerPos - $startPos);
            }

            // Optional cleanup: remove leading/trailing whitespace
            $content = trim($content);

            // Remove the top title block (row with heading-39101) to avoid duplicate titles on detail page
            // First try to remove the entire row containing the heading block
            $withoutRow = preg_replace(
                '/<div\\s+class=\"row[^\"]*mb-5[^\"]*\">.*?<div\\s+class=\"heading-39101[^\"]*\">.*?<\\/div>.*?<\\/div>\\s*/si',
                '',
                $content,
                1
            );
            if ($withoutRow !== null) {
                $content = $withoutRow;
            }
            // As a fallback, remove just the heading-39101 block if still present
            $withoutHeading = preg_replace(
                '/<div\\s+class=\"heading-39101[^\"]*\">.*?<\\/div>\\s*/si',
                '',
                $content,
                1
            );
            if ($withoutHeading !== null) {
                $content = $withoutHeading;
            }

            $dest = Destination::where('slug', $slug)->first();
            if (!$dest) {
                $this->command?->warn("No destination found for slug {$slug}, skipping.");
                continue;
            }
            $dest->leiras = $content;
            $dest->save();
            $this->command?->info("Updated description for {$slug}.");
        }
    }
}
