<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealImagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('real_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('real_id');
            $table->string('real_image'); // Corrected field name to 'image'
            $table->timestamps();

            // Foreign keys
            $table->foreign('real_id')->references('id')->on('reals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_images');
    }
}
