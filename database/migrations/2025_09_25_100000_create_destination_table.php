<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('destination')) {
            Schema::create('destination', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('title');
                $table->unsignedInteger('price_huf');
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->string('image_path'); // relative to public root, e.g. /oldal/images/olasz.jpg
                $table->string('detail_url'); // e.g. /trip-olasz
                // timestamps omitted to match legacy style
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('destination');
    }
};
