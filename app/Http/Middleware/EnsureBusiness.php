<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBusiness
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->user()?->isBusiness(), 403);

        return $next($request);
    }
}
