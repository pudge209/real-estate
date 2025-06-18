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
        Schema::create('reals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('zip_code');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('real_type'); // Changed to unsignedInteger
            $table->decimal('size');
            $table->string('status'); // Changed 'statues' to 'status'
            $table->string('description')->nullable();
            $table->boolean('pay')->default(0);
            $table->timestamps();
        });

        Schema::table('reals', function (Blueprint $table) {
            $table->string('image' ,100)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reals');
    }
};
