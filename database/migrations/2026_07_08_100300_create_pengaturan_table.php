<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha')->default('UMKM KopiKopi');
            $table->string('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->integer('stok_minimum_default')->default(10);
            $table->timestamps();
        });

        // Baris default tunggal (id = 1), supaya halaman pengaturan admin
        // punya data yang bisa langsung diedit tanpa perlu seeder terpisah.
        DB::table('pengaturan')->insert([
            'nama_usaha' => 'UMKM KopiKopi',
            'alamat' => null,
            'kontak' => null,
            'stok_minimum_default' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
