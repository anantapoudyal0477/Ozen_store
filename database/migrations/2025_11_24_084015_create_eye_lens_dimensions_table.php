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
        Schema::create('eye_lens_dimensions', function (Blueprint $table) {
              $table->id();
    $table->foreignId('eye_lens_id')->constrained('eye_lenses')->onDelete('cascade');
    $table->decimal('base_curve', 4, 2);
    $table->decimal('diameter', 4, 2);
    $table->decimal('water_content', 5, 2)->nullable();
    $table->string('oxygen_permeability')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_lens_dimensions');
    }
};
