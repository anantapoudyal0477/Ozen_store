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
        Schema::create('user_navigation_links', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);                    // Display name of the navigation link
            $table->string('route_name')->nullable();       // Laravel route name (if using named routes)
            $table->string('url')->nullable();              // External/manual URL (nullable if using route_name)
            $table->string('icon')->nullable();             // Icon class (e.g., heroicons, fontawesome)
            $table->unsignedSmallInteger('order')->default(0); // Proper ordering with unsigned type
            $table->boolean('is_active')->default(true);    // Soft toggle for showing/hiding links
            $table->string('target', 20)->default('_self'); // _self or _blank for link behavior

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_navigation_links');
    }
};
