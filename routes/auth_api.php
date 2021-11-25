<?php

use App\Http\Controllers\Api\Auth\{
    OrderTenantController,
};

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api',
    'middleware' => ['auth']
], function () {
    Route::get('my-orders', [OrderTenantController::class, 'index']);
    Route::patch('my-orders', [OrderTenantController::class, 'update']);
});
