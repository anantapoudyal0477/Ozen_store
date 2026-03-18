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
        Schema::create('eye_lens_stock_prices', function (Blueprint $table) {
         $table->id();
    $table->foreignId('eye_lens_id')->constrained('eye_lenses')->onDelete('cascade');
    $table->decimal('price', 10, 2);
    $table->integer('stock')->default(0);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_lens_stock_prices');
    }
};
