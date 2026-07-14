<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /*
    |=========================
    | MITRA MANAGEMENT
    |=========================
    */

    // LIST MITRA + STATISTIK + SEARCH + (READY PAGINATION)
    public function mitra(Request $request)
    {
        // QUERY DASAR MITRA
        $query = User::where('role', 'mitra');

        // =========================
        // SEARCH FEATURE
        // =========================
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // LIST MITRA
        $mitra = $query->latest()->get(); 
        // nanti kalau mau pagination: ganti jadi ->paginate(10)

        // =========================
        // STATISTIK
        // =========================
        $totalMitra = User::where('role', 'mitra')->count();

        $mitraAktif = User::where('role', 'mitra')
            ->where('is_active', 1)
            ->count();

        $mitraBaruBulanIni = User::where('role', 'mitra')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        return view('admin.mitra.index', compact(
            'mitra',
            'totalMitra',
            'mitraAktif',
            'mitraBaruBulanIni'
        ));
    }

    // DETAIL MITRA
    public function showMitra($id)
    {
        $mitra = User::where('role', 'mitra')
            ->where('id', $id)
            ->firstOrFail();

        return view('admin.mitra.show', compact('mitra'));
    }

    // TOGGLE AKTIF / NONAKTIF
    public function toggleMitra($id)
    {
        $mitra = User::where('role', 'mitra')
            ->where('id', $id)
            ->firstOrFail();

        $mitra->is_active = $mitra->is_active ? 0 : 1;
        $mitra->save();

        return redirect()->back()->with('success', 'Status mitra berhasil diperbarui');
    }

    // DELETE MITRA
    public function deleteMitra($id)
    {
        $mitra = User::where('role', 'mitra')
            ->where('id', $id)
            ->firstOrFail();

        $mitra->delete();

        return redirect()->back()->with('success', 'Mitra berhasil dihapus');
    }

    /*
    |=========================
    | DASHBOARD
    |=========================
    | Data ringkasan untuk kartu statistik di admin.dashboard.
    | Dipanggil dari routes/web.php untuk rute admin.dashboard.
    */
    public function dashboard()
    {
        $totalMitra = User::where('role', 'mitra')->count();

        $totalBarang = \App\Models\StokBarang::count();

        $barangMenipis = \App\Models\StokBarang::get()
            ->filter(fn ($b) => $b->status !== 'Aman')
            ->count();

        $saldoKas = \App\Models\Kas::masuk()->sum('nominal')
            - \App\Models\Kas::keluar()->sum('nominal');

        $pesananPending = \App\Models\Pemesanan::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalMitra', 'totalBarang', 'barangMenipis', 'saldoKas', 'pesananPending'
        ));
    }
}