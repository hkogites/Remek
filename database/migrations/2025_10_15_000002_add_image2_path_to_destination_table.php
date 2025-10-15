<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('destination') && !Schema::hasColumn('destination', 'image2_path')) {
            Schema::table('destination', function (Blueprint $table) {
                $table->string('image2_path')->nullable()->after('image_path');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('destination') && Schema::hasColumn('destination', 'image2_path')) {
            Schema::table('destination', function (Blueprint $table) {
                $table->dropColumn('image2_path');
            });
        }
    }
};
