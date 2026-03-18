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
 Schema::create('administrator_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('administrator_id')
                ->constrained('administrators')
                ->cascadeOnDelete();

            $table->string('designation')->nullable();
            $table->string('profile_photo')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrator_details');
    }
};
