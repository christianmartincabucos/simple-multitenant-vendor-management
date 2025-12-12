<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Organization;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class OrganizationController extends Controller
{
    use AuthorizesRequests;

    protected $organizationRepository;

    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->authorizeResource(Organization::class, 'organization');
        $this->organizationRepository = $organizationRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->organizationRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request)
    {
        return $this->organizationRepository->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        return $this->organizationRepository->find($organization->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        return $this->organizationRepository->update($organization, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $this->organizationRepository->delete($organization);
        return response()->noContent();
    }
}
