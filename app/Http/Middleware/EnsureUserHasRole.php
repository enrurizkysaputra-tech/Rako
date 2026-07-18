<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk membatasi akses halaman berdasarkan role pengguna
 * (admin, dokter, pasien).
 */
class EnsureUserHasRole
{
    /**
     * Contoh pemakaian di routes: ->middleware('role:admin')
     * atau beberapa role sekaligus: ->middleware('role:admin,dokter')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
