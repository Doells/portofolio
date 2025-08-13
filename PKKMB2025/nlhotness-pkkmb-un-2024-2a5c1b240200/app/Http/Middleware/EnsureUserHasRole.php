<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class EnsureUserHasRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $userRole = Role::find(auth()->user()->role_id);
        foreach ($roles as $role) {
            // if ($role === "superadmin" && auth()->user()->isSuperadmin()) return $next($request);
            if ($userRole->name === $role) {
                return $next($request);
            }
        }

        // returnn abort(403);
        return abort(403, 'Kamu tidak memilik izin untuk mengakses halaman tersebut.');
    }
}
