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
        if (!Schema::hasColumn('organisations', 'is_top')) {
            Schema::table('organisations', function (Blueprint $table) {
                $table->tinyInteger('is_top')->default(0)->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('organisations', 'is_top')) {
            Schema::table('organisations', function (Blueprint $table) {
                $table->dropColumn('is_top');
            });
        }
    }
};
