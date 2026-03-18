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
        Schema::create('admin_navigation_links', function (Blueprint $table) {
                $table->id();
  $table->string('name');
            $table->string('route_name')->nullable();
            $table->string('group')->nullable();   // collapsible group
            $table->boolean('top')->default(false); // top-level item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_navigation_links');
    }
};
