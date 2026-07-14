<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Membatasi akses route berdasarkan role user yang sedang login.
     * Pemakaian di route: ->middleware('role:admin') atau ->middleware('role:admin,mitra')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        if (! in_array($user->role, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        if (! $user->is_active) {
            auth()->logout();
            abort(403, 'Akun Anda telah dinonaktifkan. Hubungi admin.');
        }

        return $next($request);
    }
}
