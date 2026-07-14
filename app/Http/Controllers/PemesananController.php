<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Pemesanan;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemesananController extends Controller
{
    /**
     * ======================================================
     * DAFTAR PEMESANAN
     * ======================================================
     * Mitra hanya melihat pesanannya sendiri.
     * Admin melihat semua pesanan.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Pemesanan::with([
            'mitra',
            'barang'
        ]);

        if ($user->isMitra()) {
            $query->where('user_id', $user->id);
        }

        $pemesanan = $query
            ->latest()
            ->paginate(10);

        return view(
            'pemesanan.index',
            compact('pemesanan')
        );
    }

    /**
     * ======================================================
     * HALAMAN PEMBAYARAN
     * ======================================================
     */
    public function create(StokBarang $barang)
    {
        if ($barang->stok <= 0) {

            return redirect()
                ->route('mitra.stok')
                ->with(
                    'error',
                    'Stok barang sudah habis.'
                );
        }

        $hargaJual = $barang->harga_beli * 1.2;

        return view(
            'pemesanan.create',
            [
                'barang' => $barang,
                'hargaJual' => $hargaJual
            ]
        );
    }

    /**
     * ======================================================
     * SIMPAN PEMESANAN
     * ======================================================
     */
    public function store(Request $request)
    {
        $request->validate([

            'stok_barang_id' => [
                'required',
                'exists:stok_barang,id'
            ],

            'jumlah' => [
                'required',
                'integer',
                'min:1'
            ],

            'nama_penerima' => [
                'required',
                'string',
                'max:100'
            ],

            'no_hp' => [
                'required',
                'string',
                'max:20'
            ],

            'alamat' => [
                'required',
                'string'
            ],

            'metode_pembayaran' => [
                'required',
                'in:BRI,DANA'
            ],

            'bukti_pembayaran' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:500'
            ],

        ]);

        $barang = StokBarang::findOrFail(
            $request->stok_barang_id
        );

        if ($barang->stok <= 0) {

            return back()
                ->withInput()
                ->withErrors([
                    'jumlah' => 'Barang sudah habis.'
                ]);
        }

        if ($request->jumlah > $barang->stok) {

            return back()
                ->withInput()
                ->withErrors([
                    'jumlah' => 'Jumlah pesanan melebihi stok yang tersedia.'
                ]);
        }

        // Harga jual ke mitra (+20%)
        $hargaSatuan = $barang->harga_beli * 1.2;

        // Total pembayaran
        $totalHarga = $hargaSatuan * $request->jumlah;

        // Upload bukti pembayaran
        $buktiPembayaran = $request
            ->file('bukti_pembayaran')
            ->store(
                'bukti-pembayaran',
                'public'
            );
                    // Simpan ke database
        Pemesanan::create([

            'user_id' => $request->user()->id,

            'stok_barang_id' => $barang->id,

            // Detail Barang
            'jumlah' => $request->jumlah,
            'harga_satuan' => $hargaSatuan,
            'total_harga' => $totalHarga,

            // Data Penerima
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,

            // Pembayaran
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $buktiPembayaran,

            // Catatan
            'catatan' => $request->catatan,

            // Status awal
            'status' => 'pending',

        ]);

        return redirect()
            ->route('pemesanan.index')
            ->with(
                'success',
                'Pesanan berhasil dikirim dan sedang menunggu verifikasi admin.'
            );
    }

    /**
     * ======================================================
     * DETAIL PEMESANAN
     * ======================================================
     */
    public function show(Pemesanan $pemesanan)
    {
        $user = auth()->user();

        // Mitra hanya boleh melihat pesanannya sendiri
        if (
            $user->isMitra() &&
            $pemesanan->user_id != $user->id
        ) {
            abort(403);
        }

        $pemesanan->load([
            'mitra',
            'barang'
        ]);

        return view(
            'pemesanan.show',
            compact('pemesanan')
        );
    }

    /**
     * ======================================================
     * UPDATE STATUS PEMESANAN
     * ======================================================
     */
    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        abort_unless(
            $request->user()->isAdmin(),
            403
        );

        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
        ]);

        // Jika status berubah menjadi selesai
        if (
            $request->status == 'selesai' &&
            $pemesanan->status != 'selesai'
        ) {

            $barang = $pemesanan->barang;

            // Validasi stok
            if ($barang->stok < $pemesanan->jumlah) {

                return back()->with(
                    'error',
                    'Stok barang tidak mencukupi.'
                );
            }

            // Kurangi stok barang
            $barang->decrement(
                'stok',
                $pemesanan->jumlah
            );
                        // Tambahkan Kas Masuk
            Kas::create([

                'jenis' => 'masuk',

                'tanggal' => now()->toDateString(),

                'keterangan' =>
                    'Pembayaran pesanan ' .
                    $barang->nama_barang .
                    ' oleh ' .
                    $pemesanan->mitra->name,

                'nominal' => $pemesanan->total_harga,

                // Admin yang melakukan verifikasi
                'user_id' => $request->user()->id,

            ]);
        }

        // Update status pesanan
        $pemesanan->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }

    /**
     * ======================================================
     * HAPUS PEMESANAN
     * ======================================================
     */
    public function destroy(Request $request, Pemesanan $pemesanan)
    {
        $user = $request->user();

        // Mitra hanya boleh menghapus pesanan miliknya
        if ($user->isMitra()) {

            abort_unless(
                $pemesanan->user_id == $user->id,
                403
            );

            // Hanya pesanan pending yang boleh dihapus
            abort_unless(
                $pemesanan->status == 'pending',
                403,
                'Pesanan yang sudah diproses tidak dapat dihapus.'
            );
        }

        // Hapus file bukti pembayaran
        if (
            $pemesanan->bukti_pembayaran &&
            Storage::disk('public')->exists(
                $pemesanan->bukti_pembayaran
            )
        ) {

            Storage::disk('public')->delete(
                $pemesanan->bukti_pembayaran
            );
        }

        // Hapus data pesanan
        $pemesanan->delete();

        return back()->with(
            'success',
            'Pesanan berhasil dihapus.'
        );
    }
}