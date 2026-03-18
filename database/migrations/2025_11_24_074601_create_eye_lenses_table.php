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
        Schema::create('eye_lenses', function (Blueprint $table) {
    $table->id();
    $table->string('lens_name');
    $table->foreignId('lens_type_id')->constrained('eye_lens_types')->onDelete('cascade');
    $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
    $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
    $table->foreignId('wearing_replacement_id')->constrained('wearing_replacements')->onDelete('cascade');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_lenses');
    }
};
