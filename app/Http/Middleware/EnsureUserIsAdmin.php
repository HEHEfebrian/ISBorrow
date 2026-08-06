<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): RedirectResponse|\Illuminate\Http\Response
    {
        $user = $request->user();

        if (! $user || ! $user->is_admin) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
