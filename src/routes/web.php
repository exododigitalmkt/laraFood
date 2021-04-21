<?php

use App\Http\Controllers\Admin\{
    PlanController,
    DetailPlanController,
    UserController,
    CategoryController,
    ProductController,
    CategoryProductController,
    ACL\ProfileController,
    ACL\PermissionController,
    ACL\PermissionProfileController,
    ACL\PlanProfileController,
    TableController,
};
use App\Http\Controllers\{
    Site\SiteController,
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        /**
         * Routes Tables
         */
        Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
        Route::resource('tables', TableController::class);

        /**
         * Routes Produts
         */
        Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
        Route::resource('products', ProductController::class);

        /**
         * Routes Categories
         */
        Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::resource('categories', CategoryController::class);

        /**
         * Routes Users
         */
        Route::any('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('users', UserController::class);

        /**
         * Routes Product x Category
         */
        Route::get('products/{id}/category/{idCategory}/detach', [CategoryProductController::class, 'detachCategoryProduct'])->name('products.category.detach');
        Route::post('products/{id}/categories', [CategoryProductController::class, 'attachCategoriesProduct'])->name('products.categories.attach');
        Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('products.categories.available');
        Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories');
        Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products');

        /**
         * Routes Plan x Profile
         */
        Route::get('plans/{id}/profile/{idProfile}/detach', [PlanProfileController::class, 'detachProfilePlan'])->name('plans.profile.detach');
        Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
        Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');

        /**
         * Routes Permission x Profile
         */
        Route::get('profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach');
        Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profile.permissions.attach');
        Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
        Route::get('permissions/{id}/profiles', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');

        /**
         * Routes Permissions
         */
        Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
        Route::resource('permissions', PermissionController::class);

        /**
         * Routes Profile
         */
        Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
        Route::resource('profiles', ProfileController::class);

        /**
         * Routes Details Plans
         */
        Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
        Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
        Route::get('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
        Route::put('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
        Route::get('plans/{url}/details/{idDetaild}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
        Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
        Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');

        /**
         * Routes Plans
         */
        Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
        Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
        Route::delete('plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
        Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
        Route::put('plans/{url}', [PlanController::class, 'update'])->name('plans.update');
        Route::get('plans/edit/{url}', [PlanController::class, 'edit'])->name('plans.edit');
        Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
        Route::get('plans', [PlanController::class, 'index'])->name('plans.index');

        /**
         * Home Dashboard
         */
        Route::get('/', [PlanController::class, 'index'])->name('admin.index');
    });

/**
 * Routes Site
 */
Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
Route::get('/', [SiteController::class, 'index'])->name('site.home');

/**
 * Auth Routes
 */
Auth::routes();
