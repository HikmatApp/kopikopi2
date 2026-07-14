<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatStok extends Model
{
    protected $table = 'riwayat_stok';

    protected $fillable = [
        'stok_barang_id',
        'jenis',
        'jumlah',
        'stok_sebelum',
        'stok_sesudah',
        'user_id',
    ];

    public function barang()
    {
        return $this->belongsTo(StokBarang::class, 'stok_barang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
