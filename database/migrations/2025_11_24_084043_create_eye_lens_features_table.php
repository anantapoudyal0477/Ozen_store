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
        Schema::create('eye_lens_features', function (Blueprint $table) {
             $table->id();
    $table->foreignId('eye_lens_id')->constrained('eye_lenses')->onDelete('cascade');
    $table->foreignId('color_id')->constrained('glasses_colors')->onDelete('cascade');
    $table->boolean('uv_protection')->default(false);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_lens_features');
    }
};
