<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('user') && !Schema::hasColumn('user', 'is_admin')) {
            Schema::table('user', function (Blueprint $table) {
                $table->boolean('is_admin')->default(false)->after('password');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('user') && Schema::hasColumn('user', 'is_admin')) {
            Schema::table('user', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
    }
};
