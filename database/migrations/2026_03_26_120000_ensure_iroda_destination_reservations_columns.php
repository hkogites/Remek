<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ensure destination columns required by the desktop app / API exist.
        if (Schema::hasTable('destination')) {
            if (!Schema::hasColumn('destination', 'leiras')) {
                Schema::table('destination', function (Blueprint $table) {
                    $table->text('leiras')->nullable()->after('detail_url');
                });
            }

            if (!Schema::hasColumn('destination', 'foglallimit')) {
                Schema::table('destination', function (Blueprint $table) {
                    $table->unsignedInteger('foglallimit')->nullable()->after('leiras');
                });
            }

            if (!Schema::hasColumn('destination', 'evszak')) {
                // 1=Tél, 2=Tavasz, 3=Nyár, 4=Ősz
                Schema::table('destination', function (Blueprint $table) {
                    $table->unsignedTinyInteger('evszak')->nullable()->after('price_huf')->comment('1=Tél, 2=Tavasz, 3=Nyár, 4=Ősz');
                });
            }

            if (!Schema::hasColumn('destination', 'image2_path')) {
                Schema::table('destination', function (Blueprint $table) {
                    $table->string('image2_path')->nullable()->after('image_path');
                });
            }
        }

        // Ensure reservations columns required by the desktop app / API exist.
        if (Schema::hasTable('reservations')) {
            if (!Schema::hasColumn('reservations', 'email_sent')) {
                Schema::table('reservations', function (Blueprint $table) {
                    $table->boolean('email_sent')->default(false)->after('status');
                });
            }

            if (!Schema::hasColumn('reservations', 'admin_notes')) {
                Schema::table('reservations', function (Blueprint $table) {
                    $table->text('admin_notes')->nullable()->after('email_sent');
                });
            }

            if (!Schema::hasColumn('reservations', 'address')) {
                Schema::table('reservations', function (Blueprint $table) {
                    $table->string('address')->nullable()->after('phone');
                });
            }

            if (!Schema::hasColumn('reservations', 'people_count')) {
                Schema::table('reservations', function (Blueprint $table) {
                    $table->unsignedSmallInteger('people_count')->default(1)->after('address');
                });
            }
        }

        // Ensure user flags required by iroda-api middleware exist.
        if (Schema::hasTable('user')) {
            if (!Schema::hasColumn('user', 'is_admin')) {
                Schema::table('user', function (Blueprint $table) {
                    $table->boolean('is_admin')->default(false)->after('password');
                });
            }

            if (!Schema::hasColumn('user', 'is_iroda')) {
                Schema::table('user', function (Blueprint $table) {
                    $table->boolean('is_iroda')->default(false)->after('is_admin');
                });
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('destination')) {
            if (Schema::hasColumn('destination', 'leiras')) {
                Schema::table('destination', function (Blueprint $table) {
                    $table->dropColumn('leiras');
                });
            }
            if (Schema::hasColumn('destination', 'foglallimit')) {
                Schema::table('destination', function (Blueprint $table) {
                    $table->dropColumn('foglallimit');
                });
            }
            if (Schema::hasColumn('destination', 'evszak')) {
                Schema::table('destination', function (Blueprint $table) {
                    $table->dropColumn('evszak');
                });
            }
            if (Schema::hasColumn('destination', 'image2_path')) {
                Schema::table('destination', function (Blueprint $table) {
                    $table->dropColumn('image2_path');
                });
            }
        }

        if (Schema::hasTable('reservations')) {
            if (Schema::hasColumn('reservations', 'email_sent')) {
                Schema::table('reservations', function (Blueprint $table) {
                    $table->dropColumn('email_sent');
                });
            }
            if (Schema::hasColumn('reservations', 'admin_notes')) {
                Schema::table('reservations', function (Blueprint $table) {
                    $table->dropColumn('admin_notes');
                });
            }
            if (Schema::hasColumn('reservations', 'address')) {
                Schema::table('reservations', function (Blueprint $table) {
                    $table->dropColumn('address');
                });
            }
            if (Schema::hasColumn('reservations', 'people_count')) {
                Schema::table('reservations', function (Blueprint $table) {
                    $table->dropColumn('people_count');
                });
            }
        }

        if (Schema::hasTable('user')) {
            if (Schema::hasColumn('user', 'is_iroda')) {
                Schema::table('user', function (Blueprint $table) {
                    $table->dropColumn('is_iroda');
                });
            }
            if (Schema::hasColumn('user', 'is_admin')) {
                Schema::table('user', function (Blueprint $table) {
                    $table->dropColumn('is_admin');
                });
            }
        }
    }
};

