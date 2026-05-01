<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlatformAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('get-started');
        }

        $allowed = array_map('trim', explode(',', env('ADMIN_EMAILS', '')));

        if (! in_array($request->user()->email, $allowed)) {
            abort(403);
        }

        return $next($request);
    }
}
