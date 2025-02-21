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
        Schema::create('customer_movie', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->foreignId('customer_id');
            $table->foreignId('movie_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
