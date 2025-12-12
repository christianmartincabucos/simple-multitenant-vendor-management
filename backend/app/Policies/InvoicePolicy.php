<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
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
    public function view(User $user, Invoice $invoice): bool
    {
        if (!$user->isAdmin() && $user->organization_id !== $invoice->organization_id) {
            throw new AuthorizationException('You cannot view this invoice.');
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You are not authorized to create an invoice.');
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Invoice $invoice): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You cannot update this invoice.');
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Invoice $invoice): bool
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('You cannot delete this invoice.');
        }

        return true;
    }
}
