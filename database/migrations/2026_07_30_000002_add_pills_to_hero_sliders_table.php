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
        Schema::table('hero_sliders', function (Blueprint $table) {
            if (!Schema::hasColumn('hero_sliders', 'pill_1_label')) {
                $table->string('pill_1_label')->nullable();
                $table->string('pill_1_url')->nullable();
                $table->string('pill_2_label')->nullable();
                $table->string('pill_2_url')->nullable();
                $table->string('pill_3_label')->nullable();
                $table->string('pill_3_url')->nullable();
                $table->string('pill_4_label')->nullable();
                $table->string('pill_4_url')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_sliders', function (Blueprint $table) {
            $table->dropColumn([
                'pill_1_label', 'pill_1_url',
                'pill_2_label', 'pill_2_url',
                'pill_3_label', 'pill_3_url',
                'pill_4_label', 'pill_4_url'
            ]);
        });
    }
};
