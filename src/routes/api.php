<?php

use App\Http\Controllers\Api\{
    TenantController,
    CategoryController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('tenants/{uuid}', [TenantController::class, 'show']);
Route::get('tenants', [TenantController::class, 'index']);

Route::get('categories/{url}', [CategoryController::class, 'show']);
Route::get('categories', [CategoryController::class, 'getCategoriesByTenant']);
