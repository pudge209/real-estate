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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('real_id');
            $table->foreign('real_id')->references('id')->on('reals')->onDelete('cascade');
            $table->unsignedInteger('rooms')->nullable(); // Changed to unsignedInteger and lowercase
            $table->unsignedInteger('bedrooms')->nullable(); // Changed to unsignedInteger and lowercase
            $table->unsignedInteger('bathrooms')->nullable(); // Changed to unsignedInteger and lowercase
            $table->unsignedInteger('garage')->nullable(); // Changed to unsignedInteger
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
