<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\TenantService;
use Illuminate\Http\Request;

class SetTenantFromAuth {
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->organization) {
            app(TenantService::class)->setOrganization($user->organization);
        }

        return $next($request);
    }
}