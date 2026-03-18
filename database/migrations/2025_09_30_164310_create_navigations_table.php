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
        Schema::create('navigations', function (Blueprint $table) {
    $table->id();

    $table->string('name', 100);                      // Link display title
    $table->string('route_name')->nullable();         // Optional Laravel route (named routes)
    $table->string('url')->nullable();                // Optional external or manual URL
    $table->unsignedSmallInteger('order')->default(0); // Display position (sortable, optimized)

    $table->string('icon')->nullable();               // Icon class or file path
    $table->boolean('is_active')->default(true);      // Enable/Disable link visibility
    $table->string('target', 20)->default('_self');   // Link opening behavior: _self or _blank

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigations');
    }
};
