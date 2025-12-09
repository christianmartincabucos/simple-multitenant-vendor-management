<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\TenantService;


class SetTenantFromAuth {
    public function handle($request, Closure $next) {
        $user = $request->user();

        if($user) {
            $org = $user->organization;
            if(!$org) return response()->json(['message' => 'Organization not found'], 403);
            app(TenantService::class)->setOrganization($org);
        }
        
        return $next($request);
    }
}