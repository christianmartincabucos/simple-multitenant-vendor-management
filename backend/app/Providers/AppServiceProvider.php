<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Eloquent\VendorRepository;

use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use App\Repositories\Eloquent\InvoiceRepository;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\OrganizationRepository;
use App\Repositories\Eloquent\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\TenantService::class);

        // Base
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);

        // Tenant-aware repositories
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
