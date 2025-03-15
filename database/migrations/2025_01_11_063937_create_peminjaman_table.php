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
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'peminjam_user_id'
            )->onDelete('cascade');
            $table->foreignId('book_id')->constrained(
                table: 'books',
                indexName: 'peminjam_book_id'
            )->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tenggat_pengembalian');
            $table->dateTime('tanggal_pengembalian')->nullable();
            $table->boolean('dirating')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjam');
    }
};
