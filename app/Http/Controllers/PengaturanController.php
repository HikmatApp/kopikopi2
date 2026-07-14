<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class PengaturanController extends Controller
{
    /**
     * Halaman pengaturan. Semua role bisa edit profil akun sendiri.
     * Khusus admin, ada tambahan kartu "Pengaturan Aplikasi".
     */
    public function edit(Request $request)
    {
        $pengaturan = $request->user()->isAdmin() ? Pengaturan::current() : null;

        return view('pengaturan.edit', compact('pengaturan'));
    }

    /**
     * Update profil akun (nama & email) - berlaku untuk admin maupun mitra.
     */
    public function updateProfil(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password akun sendiri.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update([
            'password' => bcrypt($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Update pengaturan aplikasi (khusus admin): nama usaha, alamat,
     * kontak, dan ambang batas default stok minimum untuk barang baru.
     */
    public function updateAplikasi(Request $request)
    {
        abort_unless($request->user()->isAdmin(), 403);

        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:50',
            'stok_minimum_default' => 'required|integer|min:0',
        ]);

        Pengaturan::current()->update($validated);

        return back()->with('success', 'Pengaturan aplikasi berhasil diperbarui.');
    }
}
