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
        Schema::create('books_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('books_id')->constrained(
                table: 'books',
                indexName: 'book_genre_book_id'
            )->onDelete('cascade');
            $table->foreignId('genres_id')->constrained(
                table: 'genres',
                indexName: 'book_genre_genre_id'
            )->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_genres');
    }
};
