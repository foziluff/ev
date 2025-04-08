<?php

namespace App\Http\Middleware;

use App\Models\User;

class IsSuperAdmin
{
    public function handle($request, \Closure $next)
    {
        abort_if(optional(auth()->user())->role !== User::ROLE_SUPER_ADMIN, 403, 'Access denied');
        return $next($request);
    }
}
