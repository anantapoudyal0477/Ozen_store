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
        Schema::create('eye_lens_optics', function (Blueprint $table) {
            $table->id();
    $table->foreignId('eye_lens_id')->constrained('eye_lenses')->onDelete('cascade');
    $table->decimal('sphere', 4, 2)->nullable();
    $table->decimal('cylinder', 4, 2)->nullable();
    $table->smallInteger('axis')->nullable();
    $table->decimal('add_power', 4, 2)->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_lens_optics');
    }
};
