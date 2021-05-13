<?php

use App\Http\Controllers\Api\{
    TenantController,
    CategoryController,
    ProductController,
    TableController,
};
use App\Http\Controllers\Api\Auth\{
    AuthClientController,
    RegisterController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Api'
], function () {
    Route::post('sanctum/token', [AuthClientController::class, 'auth']);
});

Route::group([
    'namespace' => 'Api',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('auth/me', [AuthClientController::class, 'me']);
    Route::post('auth/logout', [AuthClientController::class, 'logout']);
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('tenants/{uuid}', [TenantController::class, 'show']);
    Route::get('tenants', [TenantController::class, 'index']);

    Route::get('categories/{url}', [CategoryController::class, 'show']);
    Route::get('categories', [CategoryController::class, 'getCategoriesByTenant']);

    Route::get('tables/{identify}', [TableController::class, 'show']);
    Route::get('tables', [TableController::class, 'getTablesByTenant']);

    Route::get('products/{flag}', [ProductController::class, 'show']);
    Route::get('products', [ProductController::class, 'getProductsByTenant']);

    Route::post('client', [RegisterController::class, 'store']);

});
