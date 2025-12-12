<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Auth\Access\AuthorizationException;

class VendorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vendor $vendor): bool
    {
        if (!$user->isAdmin() && $user->organization_id !== $vendor->organization_id) {
            throw new AuthorizationException('You cannot update this vendor.');
        }
    
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You are not authorized to create a vendor.');
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vendor $vendor): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You cannot update this vendor.');
        }
    
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vendor $vendor): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You cannot delete this vendor.');
        }
    
        return true;
    }

}
