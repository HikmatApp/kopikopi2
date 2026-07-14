<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\StokBarang;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Dashboard mitra - data asli dari database, bukan angka statis.
     */
    public function dashboard(Request $request)
    {
        $userId = $request->user()->id;

        $totalPesanan = Pemesanan::where('user_id', $userId)->count();
        $pesananPending = Pemesanan::where('user_id', $userId)->where('status', 'pending')->count();
        $pesananSelesai = Pemesanan::where('user_id', $userId)->where('status', 'selesai')->count();

        $pesananTerbaru = Pemesanan::with('barang')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('mitra.dashboard', compact(
            'totalPesanan',
            'pesananPending',
            'pesananSelesai',
            'pesananTerbaru'
        ));
    }

    /**
     * Katalog stok barang - mitra hanya boleh melihat (read-only),
     * tidak bisa edit/hapus data stok.
     */
    public function stok(Request $request)
    {
        $query = StokBarang::query();

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Hanya tampilkan barang yang masih memiliki stok
        $barang = $query->where('stok', '>', 0)
            ->latest()
            ->get();

        return view('mitra.stok', compact('barang'));
    }
}
