<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('reservations')) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('destination_id');
                $table->string('full_name');
                $table->string('email');
                $table->string('phone')->nullable();
                $table->text('note')->nullable();
                $table->string('status')->default('pending');
                $table->timestamps();

                $table->index(['user_id']);
                $table->index(['destination_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
