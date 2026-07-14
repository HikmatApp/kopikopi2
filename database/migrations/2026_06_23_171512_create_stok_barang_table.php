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
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->id();

            // Informasi Barang
            $table->string('nama_barang');
            $table->string('kategori');
            $table->string('satuan');

            // Harga beli dari supplier
            $table->decimal('harga_beli', 15, 2)->default(0);

            // Persediaan
            $table->integer('stok');
            $table->integer('stok_minimum')->default(10);

            // Deskripsi barang (opsional)
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_barang');
    }
};
