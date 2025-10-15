<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('destination')) {
            Schema::table('destination', function (Blueprint $table) {
                if (!Schema::hasColumn('destination', 'slug')) {
                    $table->string('slug')->unique()->after('id');
                }
                if (!Schema::hasColumn('destination', 'title')) {
                    $table->string('title')->after('slug');
                }
                if (!Schema::hasColumn('destination', 'price_huf')) {
                    $table->unsignedInteger('price_huf')->after('title');
                }
                if (!Schema::hasColumn('destination', 'start_date')) {
                    $table->date('start_date')->nullable()->after('price_huf');
                }
                if (!Schema::hasColumn('destination', 'end_date')) {
                    $table->date('end_date')->nullable()->after('start_date');
                }
                if (!Schema::hasColumn('destination', 'image_path')) {
                    $table->string('image_path')->after('end_date');
                }
                if (!Schema::hasColumn('destination', 'detail_url')) {
                    $table->string('detail_url')->after('image_path');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('destination')) {
            Schema::table('destination', function (Blueprint $table) {
                // Down migration intentionally left minimal to avoid data loss.
                // Columns can be dropped manually if needed.
            });
        }
    }
};
