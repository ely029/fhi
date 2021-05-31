<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleRequestApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->user()->has_chosen_role) {
            return redirect('role/request');
        }
        if (! is_null(auth()->user()->pendingRoleRequest)) {
            return redirect('role/request/pending');
        }
        return $next($request);
    }
}
