<?php
namespace App\Http\Controllers\API;

use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Http\Requests\VendorStoreRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class VendorController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected VendorRepositoryInterface $vendors) 
    {
        $this->authorizeResource(Vendor::class, 'vendor');
    }

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

    public function show(Vendor $vendor)
    {
        return new VendorResource($vendor);
    }

    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $updated = $this->vendors->update($vendor, $request->validated());
        return new VendorResource($updated);
    }

    public function destroy(Vendor $vendor)
    {
        $this->vendors->delete($vendor);
        return response()->noContent();
    }
}
