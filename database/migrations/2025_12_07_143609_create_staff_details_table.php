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
        Schema::create('staff_details', function (Blueprint $table) {
    $table->id();
    $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade');

    // Job Information
    $table->enum('role', ['receptionist', 'office_worker', 'janitor']);
    $table->string('department')->nullable();

    // Work Schedule (Default shift during season)
    $table->time('shift_start')->default('07:00');
    $table->time('shift_end')->default('18:00');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_details');
    }
};
