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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->text('name', 200);
            $table->text('description', 250);
            $table->text('category', 50);
            $table->integer('age_indication');
            $table->integer('duration');
            $table->date('release_date');
            $table->boolean('is_fan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};

// crud

// Filmes

// id
// name
// descripition
// category
// age_indication
// duration
// release_date
