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
        Schema::create('viewer_home_heroes', function (Blueprint $table) {
            $table->id();
             $table->text('title');
            $table->text('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->text('background_image')->nullable();
            $table->text('badge_text')->nullable();
            $table->json('stats')->nullable(); // [{"label":"Unique Styles","value":"500+"},...]
            $table->timestamps();

            // $table->foreign('stats')->references('id')->on('viewer_home_hero_stats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viewer_home_heroes');
    }
};
