<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;

class HealthCareWorker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     *
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role_id === 3) {
            return $next($request);
        }

        return abort(Response::HTTP_FORBIDDEN);
    }
}
