<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'nama_usaha',
        'alamat',
        'kontak',
        'stok_minimum_default',
    ];

    /**
     * Ambil baris pengaturan tunggal (selalu id = 1).
     * Kalau belum ada (misal lupa migrate), buat otomatis dengan nilai default.
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'nama_usaha' => 'UMKM KopiKopi',
            'stok_minimum_default' => 10,
        ]);
    }
}
