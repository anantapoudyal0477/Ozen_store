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
        Schema::create('viewer_home_ctas', function (Blueprint $table) {
            $table->id();
             $table->text('heading');
            $table->text('description')->nullable();
            $table->text('button_text')->nullable();
            $table->text('button_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viewer_home_ctas');
    }
};
