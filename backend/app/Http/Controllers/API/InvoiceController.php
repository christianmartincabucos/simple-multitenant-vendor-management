<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceIndexRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct(protected InvoiceService $service) {}

    public function index(Request $request)
    {
        $paginator = $this->service->list(
            $request->only(['status', 'vendor_id']),
            $request->get('per_page', 15)
        );
        return InvoiceResource::collection($paginator);
    }

    public function store(StoreInvoiceRequest $request)
    {
        $invoice = $this->service->create($request->validated(), $request->user());
        return new InvoiceResource($invoice);
    }

    public function show(int $id)
    {
        $invoice = $this->service->findOrFail($id);
        return new InvoiceResource($invoice);
    }

    public function update(UpdateInvoiceRequest $request, int $id)
    {
        $invoice = $this->service->findOrFail($id);
        $updated = $this->service->update($invoice, $request->validated(), $request->user());
        return new InvoiceResource($updated);
    }

    public function destroy(int $id)
    {
        $invoice = $this->service->findOrFail($id);
        $this->service->delete($invoice, request()->user());
        return response()->noContent();
    }
}
