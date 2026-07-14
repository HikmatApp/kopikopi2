<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Kelola seluruh pengguna (admin + mitra) dalam satu halaman,
     * bisa difilter berdasarkan role.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role') && in_array($request->role, ['admin', 'mitra'], true)) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Ubah role user (admin <-> mitra). Admin tidak bisa menurunkan
     * role dirinya sendiri supaya tidak terkunci dari sistem.
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,mitra',
        ]);

        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Anda tidak bisa mengubah role akun sendiri.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Role pengguna berhasil diperbarui.');
    }

    /**
     * Aktifkan / nonaktifkan akun.
     */
    public function toggleActive(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Anda tidak bisa menonaktifkan akun sendiri.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'Status pengguna berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
