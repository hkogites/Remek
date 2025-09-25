<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('reservations')) {
            Schema::table('reservations', function (Blueprint $table) {
                if (!Schema::hasColumn('reservations', 'address')) {
                    $table->string('address')->nullable()->after('phone');
                }
                if (!Schema::hasColumn('reservations', 'people_count')) {
                    $table->unsignedSmallInteger('people_count')->default(1)->after('address');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('reservations')) {
            Schema::table('reservations', function (Blueprint $table) {
                if (Schema::hasColumn('reservations', 'people_count')) {
                    $table->dropColumn('people_count');
                }
                if (Schema::hasColumn('reservations', 'address')) {
                    $table->dropColumn('address');
                }
            });
        }
    }
};
