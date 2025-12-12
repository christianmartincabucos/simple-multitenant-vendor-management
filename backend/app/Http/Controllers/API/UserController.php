<?php
namespace App\Http\Controllers\API;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use App\Http\Resources\UserResource;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function index()
    {
        $users = $this->service->list();
        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->service->create($request->validated(), $request->user());
        return new UserResource($user);
    }

    public function show($id)
    {
        $user = $this->service->findOrFail($id);
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->service->findOrFail($id);
        $updated = $this->service->update($user, $request->validated(), $request->user());
        return new UserResource($updated);
    }

    public function destroy($id)
    {
        $user = $this->service->findOrFail($id);
        $this->service->delete($user, request()->user());
        return response()->noContent();
    }
}
