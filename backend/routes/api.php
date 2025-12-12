<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VendorController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\OrganizationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::post('auth/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
| All routes below require Sanctum authentication and tenant context
*/
Route::middleware(['auth:sanctum', 'set.tenant'])->group(function () {

    // Auth
    Route::post('auth/logout', [AuthController::class, 'logout']);

    // Invoices CRUD
    Route::apiResource('invoices', InvoiceController::class);

    // Vendors CRUD
    Route::apiResource('vendors', VendorController::class);

    // Users CRUD (admin only)
    Route::apiResource('users', UserController::class)->middleware('can:manage-users');

    // Organizations CRUD (admin only)
    Route::apiResource('organizations', OrganizationController::class);
});
