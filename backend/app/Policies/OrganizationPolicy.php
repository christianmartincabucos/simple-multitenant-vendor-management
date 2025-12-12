<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;

class OrganizationPolicy
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
    public function view(User $user, Organization $organization): bool
    {
        if (!$user->isAdmin() && $user->organization_id !== $organization->id) {
            throw new AuthorizationException('You cannot view this organization.');
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You are not authorized to create an organization.');
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Organization $organization): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You are not authorized to create an organization.');
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Organization $organization): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You are not authorized to create an organization.');
        }

        return true;
    }
}