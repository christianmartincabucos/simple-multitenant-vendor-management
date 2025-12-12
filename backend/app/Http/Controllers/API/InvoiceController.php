<?php
namespace App\Http\Controllers\API;

use App\Services\InvoiceService;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InvoiceController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected InvoiceService $service) 
    {
        $this->authorizeResource(Invoice::class, 'invoice');
    }

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

    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $updated = $this->service->update($invoice, $request->validated(), $request->user());
        return new InvoiceResource($updated);
    }

    public function destroy(Invoice $invoice)
    {
        $this->service->delete($invoice, request()->user());
        return response()->noContent();
    }
}
