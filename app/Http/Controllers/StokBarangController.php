<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\RiwayatStok;
use App\Models\Kas;

class StokBarangController extends Controller
{
    /**
     * Daftar kategori barang
     */
    private array $kategori = [
        'Bahan Baku',
        'Kemasan',
        'Kebutuhan Lainnya'
    ];

    /**
     * Daftar satuan barang
     */
    private array $satuan = [
        'Kg',
        'Gram',
        'Liter',
        'Ml',
        'Pcs',
        'Pack',
        'Botol',
        'Dus'
    ];

    /**
     * Tampilkan data stok
     */
    public function index(Request $request)
    {
        $query = StokBarang::query();

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $barang = $query->latest()->get();

        $barangMenipis = StokBarang::all()
            ->filter(fn($b) => $b->status !== 'Aman')
            ->count();

        return view('admin.stok.index', [
            'barang' => $barang,
            'barangMenipis' => $barangMenipis,
            'kategoriList' => $this->kategori,
            'satuanList' => $this->satuan
        ]);
    }

    /**
     * Form tambah barang
     */
    public function create()
    {
        return view('admin.stok.create', [
            'kategoriList' => $this->kategori,
            'satuanList' => $this->satuan
        ]);
    }

    /**
     * Simpan barang
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:Bahan Baku,Kemasan,Kebutuhan Lainnya',
            'satuan' => 'required|in:Kg,Gram,Liter,Ml,Pcs,Pack,Botol,Dus',
            'harga_beli' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        $barang = StokBarang::create($validated);

        // Riwayat stok
        if ($barang->stok > 0) {

            RiwayatStok::create([
                'stok_barang_id' => $barang->id,
                'jenis' => 'masuk',
                'jumlah' => $barang->stok,
                'stok_sebelum' => 0,
                'stok_sesudah' => $barang->stok,
                'user_id' => auth()->id(),
            ]);

            // Catat modal sebagai Kas Keluar
            Kas::create([
                'jenis' => 'keluar',
                'tanggal' => now()->toDateString(),
                'keterangan' => 'Pembelian stok ' . $barang->nama_barang,
                'nominal' => $barang->stok * $barang->harga_beli,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()
            ->route('admin.stok.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Detail barang
     */
    public function show($id)
    {
        $barang = StokBarang::findOrFail($id);

        $riwayat = $barang->riwayat()
            ->with('user')
            ->latest()
            ->take(20)
            ->get();

        return view('admin.stok.show', compact('barang', 'riwayat'));
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $barang = StokBarang::findOrFail($id);

        return view('admin.stok.edit', [
            'barang' => $barang,
            'kategoriList' => $this->kategori,
            'satuanList' => $this->satuan
        ]);
    }

    /**
     * Update barang
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:Bahan Baku,Kemasan,Kebutuhan Lainnya',
            'satuan' => 'required|in:Kg,Gram,Liter,Ml,Pcs,Pack,Botol,Dus',
            'harga_beli' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        $barang = StokBarang::findOrFail($id);

        $stokSebelum = $barang->stok;

        $barang->update($validated);

        $stokSesudah = $barang->stok;

        $selisih = $stokSesudah - $stokSebelum;

        // Jika stok bertambah
        if ($selisih > 0) {

            RiwayatStok::create([
                'stok_barang_id' => $barang->id,
                'jenis' => 'masuk',
                'jumlah' => $selisih,
                'stok_sebelum' => $stokSebelum,
                'stok_sesudah' => $stokSesudah,
                'user_id' => auth()->id(),
            ]);

            // Catat modal tambahan
            Kas::create([
                'jenis' => 'keluar',
                'tanggal' => now()->toDateString(),
                'keterangan' => 'Penambahan stok ' . $barang->nama_barang,
                'nominal' => $selisih * $barang->harga_beli,
                'user_id' => auth()->id(),
            ]);

        }

        // Jika stok berkurang
        elseif ($selisih < 0) {

            RiwayatStok::create([
                'stok_barang_id' => $barang->id,
                'jenis' => 'keluar',
                'jumlah' => abs($selisih),
                'stok_sebelum' => $stokSebelum,
                'stok_sesudah' => $stokSesudah,
                'user_id' => auth()->id(),
            ]);

        }

        return redirect()
            ->route('admin.stok.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Hapus barang
     */
    public function destroy($id)
    {
        $barang = StokBarang::findOrFail($id);

        $barang->delete();

        return redirect()
            ->route('admin.stok.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}