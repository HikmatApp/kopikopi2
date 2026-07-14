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
        Schema::create('pemesanan', function (Blueprint $table) {

            $table->id();

            // Mitra yang melakukan pemesanan
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Barang yang dipesan
            $table->foreignId('stok_barang_id')
                ->constrained('stok_barang')
                ->cascadeOnDelete();

            // Detail Barang
            $table->integer('jumlah');

            // Harga jual ke mitra (harga beli +20%)
            $table->decimal('harga_satuan', 15, 2);

            // Total pembayaran
            $table->decimal('total_harga', 15, 2);

            // Data penerima
            $table->string('nama_penerima');
            $table->string('no_hp');
            $table->text('alamat');

            // Pembayaran
            $table->enum('metode_pembayaran', [
                'BRI',
                'DANA'
            ]);

            // Bukti transfer
            $table->string('bukti_pembayaran');

            // Catatan tambahan
            $table->text('catatan')->nullable();

            // Status pesanan
            $table->enum('status', [
                'pending',
                'diproses',
                'selesai',
                'ditolak'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
