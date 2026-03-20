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
         
        Schema::create('order_items', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('order_id');

    // 👇 make product optional
    $table->unsignedBigInteger('product_id')->nullable();

    // 👇 ADD THIS (VERY IMPORTANT)
    $table->unsignedBigInteger('eye_lens_id')->nullable();

    $table->integer('quantity');
    $table->text('isPrescription')->nullable();

    $table->timestamps();

    // relations
    $table->foreign('order_id')
        ->references('id')->on('orders')
        ->onDelete('cascade');

    $table->foreign('product_id')
        ->references('id')->on('products')
        ->onDelete('cascade');

    // 👇 NEW relation
    $table->foreign('eye_lens_id')
        ->references('id')->on('eye_lenses')
        ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
