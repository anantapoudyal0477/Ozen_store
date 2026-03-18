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
        Schema::create('prescription_glasses', function (Blueprint $table) {
    $table->id();

    $table->foreignId('prescription_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->enum('eye', ['left', 'right']);

    $table->decimal('sphere', 4, 2)->nullable();
    $table->decimal('cylinder', 4, 2)->nullable();
    $table->integer('axis')->nullable();

    $table->timestamps();

    $table->unique(['prescription_id', 'eye']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_glasses');
    }
};
