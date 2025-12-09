<?php
namespace App\Repositories\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface InvoiceRepositoryInterface extends BaseRepositoryInterface
{
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}