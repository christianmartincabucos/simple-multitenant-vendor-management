<?php
namespace App\Services;

use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;

class InvoiceService
{
    protected InvoiceRepositoryInterface $invoices;

    public function __construct(InvoiceRepositoryInterface $invoices)
    {
        $this->invoices = $invoices;
    }

    public function list(array $filters = [], int $perPage = 15)
    {
        return $this->invoices->paginate($perPage, $filters);
    }

    public function findOrFail(int $id)
    {
        $invoice = $this->invoices->find($id);
        if (!$invoice) {
            throw new ModelNotFoundException('Invoice not found');
        }
        return $invoice;
    }

    public function create(array $data, User $actor)
    {
        if (!$actor->isAdmin()) {
            throw new AuthorizationException('Only admin can create invoices');
        }

        $data['organization_id'] = app(TenantService::class)->getId();
        return $this->invoices->create($data);
    }

    public function update($invoice, array $data, User $actor)
    {
        if (!$actor->isAdmin()) {
            throw new AuthorizationException('Only admin can update invoices');
        }

        return $this->invoices->update($invoice, $data);
    }

    public function delete($invoice, User $actor)
    {
        if (!$actor->isAdmin()) {
            throw new AuthorizationException('Only admin can delete invoices');
        }

        return $this->invoices->delete($invoice);
    }
}
