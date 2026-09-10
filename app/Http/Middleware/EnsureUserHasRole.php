<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $allowed = array_map(fn (string $role) => Role::from($role), $roles);

        if (! $request->user() || ! $request->user()->is_active) {
            abort(403);
        }

        if (! in_array($request->user()->role, $allowed, true)) {
            abort(403);
        }

        return $next($request);
    }
}
