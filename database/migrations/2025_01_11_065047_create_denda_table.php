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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'fine_user_id'
            )->onDelete('cascade');
            $table->foreignId('book_id')->constrained(
                table: 'books',
                indexName: 'fine_book_id'
            )->onDelete('cascade');
            $table->string('jumlah');
            $table->enum('status_pembayaran', ['dibayar', 'belum dibayar']);
            $table->enum('alasan', ['Telat mengembalikan buku', 'Tidak mengambil buku yang sudah direservasi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
