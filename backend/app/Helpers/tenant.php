<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;

if (!function_exists('tenant')) {
    /**
     * Returns the authenticated user's organization_id.
     */
    function tenant(): int
    {
        /** @var User|null */
        $user = Auth::user();
        return $user?->organization_id ?? 0;
    }
}
