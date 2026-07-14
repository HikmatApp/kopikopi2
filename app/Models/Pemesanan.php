<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StokBarang;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';


    protected $fillable = [

        'user_id',

        'stok_barang_id',


        // Data Pesanan
        'jumlah',
        'harga_satuan',
        'total_harga',


        // Data Penerima
        'nama_penerima',
        'no_hp',
        'alamat',


        // Pembayaran
        'metode_pembayaran',
        'bukti_pembayaran',


        // Status
        'status',
        'catatan',

    ];



    /**
     * Casting data
     */
    protected $casts = [

        'harga_satuan' => 'decimal:2',

        'total_harga' => 'decimal:2',

        'jumlah' => 'integer',

    ];





    /**
     * Relasi Mitra
     *
     * pemesanan.user_id
     * menuju users.id
     */
    public function mitra()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }





    /**
     * Relasi Barang
     *
     * pemesanan.stok_barang_id
     * menuju stok_barang.id
     */
    public function barang()
    {
        return $this->belongsTo(
            StokBarang::class,
            'stok_barang_id',
            'id'
        );
    }





    /**
     * URL Bukti Pembayaran
     */
    public function getBuktiPembayaranUrlAttribute()
    {
        if (!$this->bukti_pembayaran) {

            return null;
        }


        return asset(
            'storage/' . $this->bukti_pembayaran
        );
    }





    /**
     * Badge Status
     */
    public function getStatusBadgeAttribute(): string
    {

        return match ($this->status) {


            'pending' =>
            'bg-yellow-100 text-yellow-700',


            'diproses' =>
            'bg-blue-100 text-blue-700',


            'selesai' =>
            'bg-green-100 text-green-700',


            'ditolak' =>
            'bg-red-100 text-red-700',


            default =>
            'bg-gray-100 text-gray-700',
        };
    }





    /**
     * Format Harga Satuan
     */
    public function getHargaSatuanFormatAttribute(): string
    {

        return 'Rp ' .
            number_format(
                $this->harga_satuan,
                0,
                ',',
                '.'
            );
    }





    /**
     * Format Total Harga
     */
    public function getTotalHargaFormatAttribute(): string
    {

        return 'Rp ' .
            number_format(
                $this->total_harga,
                0,
                ',',
                '.'
            );
    }





    /**
     * Nama Metode Pembayaran
     */
    public function getMetodePembayaranTextAttribute(): string
    {

        return match ($this->metode_pembayaran) {


            'BRI' =>
            'Transfer Bank BRI',


            'DANA' =>
            'DANA',


            default =>
            '-',
        };
    }





    /**
     * Nomor Pembayaran
     */
    public function getNomorPembayaranAttribute(): string
    {

        return match ($this->metode_pembayaran) {


            'BRI' =>
            '00639821093805',


            'DANA' =>
            '0895385486145',


            default =>
            '-',
        };
    }
}
