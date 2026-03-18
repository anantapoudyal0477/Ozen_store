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
        //
        Schema::create('wearing_replacements', function (Blueprint $table) {
            $table->id();
            $table->enum('replacement_cycle', ['Daily', 'Biweekly', 'Monthly', 'Yearly']);
            $table->enum('wearing_schedule', ['Daily Wear', 'Extended Wear']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('wearing_replacements');
    }
};
