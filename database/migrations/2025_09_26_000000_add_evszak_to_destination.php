<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('destination') && !Schema::hasColumn('destination', 'evszak')) {
            Schema::table('destination', function (Blueprint $table) {
                // 1=Tél, 2=Tavasz, 3=Nyár, 4=Ősz
                $table->unsignedTinyInteger('evszak')->nullable()->after('price_huf')->comment('1=Tél, 2=Tavasz, 3=Nyár, 4=Ősz');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('destination') && Schema::hasColumn('destination', 'evszak')) {
            Schema::table('destination', function (Blueprint $table) {
                $table->dropColumn('evszak');
            });
        }
    }
};
