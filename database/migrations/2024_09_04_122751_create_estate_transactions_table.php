<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estate_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('real_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('transaction_type');
            $table->unsignedBigInteger('price');
            $table->text('details');
            $table->timestamps();

            // Foreign keys
            $table->foreign('real_id')->references('id')->on('reals')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estate_transactions');
    }
}
