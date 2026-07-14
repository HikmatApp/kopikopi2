<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Pemesanan;
use App\Models\RiwayatStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Tampilkan laporan sesuai role yang login.
     * - Admin  : laporan arus kas + laporan pergerakan stok, seluruh data.
     * - Mitra  : laporan riwayat pesanan miliknya sendiri saja.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        if ($user->isAdmin()) {
            $kas = $this->queryKas($dari, $sampai)->get();

            $totalMasuk = $kas->where('jenis', 'masuk')->sum('nominal');
            $totalKeluar = $kas->where('jenis', 'keluar')->sum('nominal');
            $saldo = $totalMasuk - $totalKeluar;

            $riwayatStok = $this->queryRiwayatStok($dari, $sampai)->get();

            return view('laporan.admin', compact(
                'kas', 'totalMasuk', 'totalKeluar', 'saldo', 'riwayatStok', 'dari', 'sampai'
            ));
        }

        // MITRA: dipaksa hanya melihat pesanan miliknya sendiri, tidak
        // menerima parameter user_id apapun dari request untuk mencegah
        // mitra mengintip data mitra lain.
        $pemesanan = $this->queryPemesananMitra($user->id, $dari, $sampai)->get();

        return view('laporan.mitra', compact('pemesanan', 'dari', 'sampai'));
    }

    /**
     * Export data laporan ke CSV (dibuka dengan Excel).
     *
     * Catatan implementasi: export ini pakai format CSV manual karena
     * lingkungan build project ini tidak punya akses ke Packagist untuk
     * meng-install package seperti maatwebsite/excel. CSV tetap terbuka
     * sempurna di Microsoft Excel / LibreOffice. Kalau nanti mau file
     * .xlsx asli, tinggal composer require maatwebsite/excel lalu ganti
     * method ini pakai Excel::download().
     */
    public function export(Request $request)
    {
        $user = $request->user();
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        if ($user->isAdmin()) {
            return $this->exportAdmin($dari, $sampai);
        }

        return $this->exportMitra($user->id, $dari, $sampai);
    }

    private function exportAdmin(?string $dari, ?string $sampai)
    {
        $kas = $this->queryKas($dari, $sampai)->get();

        $filename = 'laporan-kas-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($kas) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Tanggal', 'Jenis', 'Keterangan', 'Nominal', 'Dicatat Oleh']);

            foreach ($kas as $row) {
                fputcsv($handle, [
                    $row->tanggal->format('d-m-Y'),
                    ucfirst($row->jenis),
                    $row->keterangan,
                    (float) $row->nominal,
                    $row->user->name ?? '-',
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    private function exportMitra(int $userId, ?string $dari, ?string $sampai)
    {
        // user_id di-hardcode dari user yang login, BUKAN dari request,
        // supaya mitra tidak mungkin export data pesanan mitra lain.
        $pemesanan = $this->queryPemesananMitra($userId, $dari, $sampai)->get();

        $filename = 'laporan-pesanan-saya-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($pemesanan) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Tanggal', 'Barang', 'Jumlah', 'Status', 'Catatan']);

            foreach ($pemesanan as $row) {
                fputcsv($handle, [
                    $row->created_at->format('d-m-Y H:i'),
                    $row->barang->nama_barang ?? '-',
                    $row->jumlah,
                    ucfirst($row->status),
                    $row->catatan ?? '-',
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    private function queryKas(?string $dari, ?string $sampai)
    {
        $query = Kas::with('user');

        if ($dari) {
            $query->whereDate('tanggal', '>=', $dari);
        }

        if ($sampai) {
            $query->whereDate('tanggal', '<=', $sampai);
        }

        return $query->orderBy('tanggal');
    }

    private function queryRiwayatStok(?string $dari, ?string $sampai)
    {
        $query = RiwayatStok::with(['barang', 'user']);

        if ($dari) {
            $query->whereDate('created_at', '>=', $dari);
        }

        if ($sampai) {
            $query->whereDate('created_at', '<=', $sampai);
        }

        return $query->orderByDesc('created_at');
    }

    private function queryPemesananMitra(int $userId, ?string $dari, ?string $sampai)
    {
        $query = Pemesanan::with('barang')->where('user_id', $userId);

        if ($dari) {
            $query->whereDate('created_at', '>=', $dari);
        }

        if ($sampai) {
            $query->whereDate('created_at', '<=', $sampai);
        }

        return $query->orderByDesc('created_at');
    }
}
