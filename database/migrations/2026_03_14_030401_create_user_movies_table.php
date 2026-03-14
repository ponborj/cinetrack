<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('user_movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('tmdb_id');
            $table->string('title'); // Cache do título
            $table->string('poster_path')->nullable(); // Cache do pôster
            $table->integer('runtime')->default(0); // Para calcular as horas assistidas
            $table->enum('status', ['watched', 'watchlist']);
            $table->decimal('rating', 3, 1)->nullable(); // Ex: 9.5
            $table->text('review')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->timestamps();

            // Um usuário não pode adicionar o mesmo filme duas vezes (por enquanto)
            $table->unique(['user_id', 'tmdb_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_movies');
    }
};
