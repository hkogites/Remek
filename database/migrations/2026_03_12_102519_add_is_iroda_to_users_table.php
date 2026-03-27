<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('user') && !Schema::hasColumn('user', 'is_iroda')) {
            Schema::table('user', function (Blueprint $table) {
                $table->boolean('is_iroda')->default(false)->after('is_admin');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('user') && Schema::hasColumn('user', 'is_iroda')) {
            Schema::table('user', function (Blueprint $table) {
                $table->dropColumn('is_iroda');
            });
        }
    }
};
