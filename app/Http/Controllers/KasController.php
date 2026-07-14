<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    /**
     * Dashboard Keuangan
     */
    public function index(Request $request, string $jenis = null)
    {
        $query = Kas::with('user');

        // Filter tanggal
        if ($request->filled('dari')) {
            $query->whereDate('tanggal', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal', '<=', $request->sampai);
        }

        // Filter jenis (opsional)
        if ($request->filled('filter_jenis')) {
            $query->where('jenis', $request->filter_jenis);
        }

        // Riwayat transaksi gabungan
        $transaksi = $query
            ->latest('tanggal')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        // Ringkasan Keuangan
        $totalKasMasuk = Kas::where('jenis', 'masuk')->sum('nominal');

        $totalKasKeluar = Kas::where('jenis', 'keluar')->sum('nominal');

        $saldoKas = $totalKasMasuk - $totalKasKeluar;

        return view('admin.kas.index', [
            'transaksi'      => $transaksi,
            'totalKasMasuk'  => $totalKasMasuk,
            'totalKasKeluar' => $totalKasKeluar,
            'saldoKas'       => $saldoKas,
        ]);
    }

    /**
     * Form tambah transaksi
     */
    public function create(string $jenis)
    {
        $this->validateJenis($jenis);

        return view('admin.kas.create', compact('jenis'));
    }

    /**
     * Simpan transaksi
     */
    public function store(Request $request, string $jenis)
    {
        $this->validateJenis($jenis);

        $validated = $request->validate([
            'tanggal'    => 'required|date',
            'keterangan' => 'required|string|max:255',
            'nominal'    => 'required|numeric|min:1',
        ]);

        $validated['jenis'] = $jenis;
        $validated['user_id'] = auth()->id();

        Kas::create($validated);

        return redirect()
            ->route('admin.kas.index', $jenis)
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Hapus transaksi
     */
    public function destroy(Kas $kas)
    {
        $kas->delete();

        return back()->with(
            'success',
            'Transaksi berhasil dihapus.'
        );
    }

    /**
     * Validasi jenis transaksi
     */
    private function validateJenis(string $jenis): void
    {
        abort_unless(
            in_array($jenis, ['masuk', 'keluar']),
            404
        );
    }
}