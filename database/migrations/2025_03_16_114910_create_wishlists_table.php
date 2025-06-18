<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('real_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('real_id')->references('id')->on('reals')->onDelete('cascade');
            $table->unique(['user_id', 'real_id']); // Prevent duplicate wishlist entries
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
