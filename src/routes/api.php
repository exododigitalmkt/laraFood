<?php

use App\Http\Controllers\Api\{
    TenantController,
    CategoryController,
    EvaluationController,
    OrderController,
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

    Route::post('auth/v1/orders/{identifyOrder}/evaluations', [EvaluationController::class, 'store']);

    Route::get('auth/v1/my-orders', [OrderController::class, 'myOrders']);
    Route::post('auth/v1/orders', [OrderController::class, 'store']);
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('tenants/{uuid}', [TenantController::class, 'show']);
    Route::get('tenants', [TenantController::class, 'index']);

    Route::get('categories/{identify}', [CategoryController::class, 'show']);
    Route::get('categories', [CategoryController::class, 'getCategoriesByTenant']);

    Route::get('tables/{identify}', [TableController::class, 'show']);
    Route::get('tables', [TableController::class, 'getTablesByTenant']);

    Route::get('products/{identify}', [ProductController::class, 'show']);
    Route::get('products', [ProductController::class, 'getProductsByTenant']);

    Route::post('client', [RegisterController::class, 'store']);

    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{identify}', [OrderController::class, 'show']);
});
