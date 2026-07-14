<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    protected $table = 'stok_barang';

    protected $fillable = [
        'nama_barang',
        'kategori',
        'satuan',
        'harga_beli',
        'stok',
        'stok_minimum',
        'deskripsi'
    ];

    /*
    |--------------------------------------------------------------------------
    | Status Stok
    |--------------------------------------------------------------------------
    */

    public function getStatusAttribute()
    {
        if ($this->stok <= 0) {
            return 'Habis';
        }

        if ($this->stok <= $this->stok_minimum) {
            return 'Menipis';
        }

        return 'Aman';
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Habis'   => 'bg-red-100 text-red-700',
            'Menipis' => 'bg-yellow-100 text-yellow-700',
            default   => 'bg-green-100 text-green-700',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Harga
    |--------------------------------------------------------------------------
    */

    /**
     * Harga jual otomatis = Harga beli + 20%
     */
    public function getHargaJualAttribute()
    {
        return $this->harga_beli * 1.20;
    }

    /**
     * Format harga beli
     */
    public function getHargaBeliFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga_beli, 0, ',', '.');
    }

    /**
     * Format harga jual
     */
    public function getHargaJualFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function riwayat()
    {
        return $this->hasMany(RiwayatStok::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
