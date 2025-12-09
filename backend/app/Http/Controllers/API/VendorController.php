<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Http\Requests\VendorStoreRequest;
use App\Http\Resources\VendorResource;

class VendorController extends Controller
{
    public function __construct(protected VendorRepositoryInterface $vendors) {}

    public function index()
    {
        $vendors = $this->vendors->paginate();
        return VendorResource::collection($vendors);
    }

    public function store(StoreVendorRequest $request)
    {
        $vendor = $this->vendors->create($request->validated());
        return new VendorResource($vendor);
    }

    public function show(int $id)
    {
        $vendor = $this->vendors->findOrFail($id);
        return new VendorResource($vendor);
    }

    public function update(UpdateVendorRequest $request, int $id)
    {
        $vendor = $this->vendors->findOrFail($id);
        $updated = $this->vendors->update($vendor, $request->validated());
        return new VendorResource($updated);
    }

    public function destroy(int $id)
    {
        $vendor = $this->vendors->findOrFail($id);
        $this->vendors->delete($vendor);
        return response()->noContent();
    }
}
