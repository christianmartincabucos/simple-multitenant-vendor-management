<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only admin can update users
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $userId = $this->route('user'); // id from route parameter

        return [
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,accountant',
        ];
    }
}
