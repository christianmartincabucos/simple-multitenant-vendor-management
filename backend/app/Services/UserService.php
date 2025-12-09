<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;

class UserService
{
    public function __construct(protected UserRepositoryInterface $users) {}

    /**
     * List users with optional filters
     */
    public function list(array $filters = [], int $perPage = 15)
    {
        return $this->users->paginate($perPage, $filters);
    }

    /**
     * Create a new user
     */
    public function create(array $data, User $actor): User
    {
        if (!$actor->isAdmin()) {
            throw new AuthorizationException('Only admin can create users');
        }

        $data['password'] = bcrypt($data['password']);
        $data['organization_id'] = app(TenantService::class)->getId();

        return $this->users->create($data);
    }

    /**
     * Update existing user
     */
    public function update(User $user, array $data, User $actor): User
    {
        if (!$actor->isAdmin()) {
            throw new AuthorizationException('Only admin can update users');
        }

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->users->update($user, $data);
    }

    /**
     * Delete a user
     */
    public function delete(User $user, User $actor): bool
    {
        if (!$actor->isAdmin()) {
            throw new AuthorizationException('Only admin can delete users');
        }

        return $this->users->delete($user);
    }

    /**
     * Find user by ID or fail
     */
    public function findOrFail(int $id): User
    {
        return $this->users->findOrFail($id);
    }
}
