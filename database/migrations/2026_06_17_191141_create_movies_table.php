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

            $table->string('imdb_id')->unique();

            $table->string('title')->index();

            $table->string('year', 10)->index();

            $table->string('genre')->index();

            $table->string('director');

            $table->text('plot');

            $table->string('poster_url');

            $table->decimal('imdb_rating', 3, 1);

            $table->string('runtime', 50);

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
