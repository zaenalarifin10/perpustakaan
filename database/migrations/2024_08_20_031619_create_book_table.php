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
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->string('isbn');
            $table->string('judul_buku');
            $table->string('jenis');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('genre')->nullable();
            $table->longtext('sinopsis');
            $table->string('cover')->nullable();
            $table->integer('stok')->default(0);
            $table->integer('terpinjam')->default(0);
            $table->string('sisa_buku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
