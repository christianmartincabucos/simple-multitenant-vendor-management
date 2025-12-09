<?php
namespace App\Services;

use App\Repositories\Contracts\VendorRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VendorService
{
    protected VendorRepositoryInterface $vendors;

    public function __construct(VendorRepositoryInterface $vendors)
    {
        $this->vendors = $vendors;
    }

    public function findOrFail(int $id)
    {
        $vendor = $this->vendors->find($id);
        if (!$vendor) {
            throw new ModelNotFoundException('Vendor not found');
        }
        return $vendor;
    }

    public function create(array $data)
    {
        return $this->vendors->create($data);
    }

    public function update($vendor, array $data)
    {
        return $this->vendors->update($vendor, $data);
    }

    public function delete($vendor)
    {
        return $this->vendors->delete($vendor);
    }
}
