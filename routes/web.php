
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Models\Category;

// Dashboard
Route::get('/admin/dashboard', [
    DashboardController::class,
    'index'
])->name('admin.dashboard');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    // =========================
    // Categories and Subcategories
    // =========================

    Route::get('/categories', [
        CategoryController::class,
        'index'
    ])->name('categories.index');

    Route::get('/categories/create', function () {
        $categories = Category::orderBy('name')->get();

        return view('admin.categories-create', compact('categories'));
    })->name('categories.create');

    Route::post('/categories', [
        CategoryController::class,
        'store'
    ])->name('categories.store');

    Route::get('/categories/{category}/edit', [
        CategoryController::class,
        'edit'
    ])->name('categories.edit');

    Route::put('/categories/{category}', [
        CategoryController::class,
        'update'
    ])->name('categories.update');

    Route::delete('/categories/{category}', [
        CategoryController::class,
        'destroy'
    ])->name('categories.destroy');

    Route::post('/categories/{category}/subcategories', [
        CategoryController::class,
        'storeSubcategory'
    ])->name('categories.subcategories.store');

    Route::put('/subcategories/{subcategory}', [
        CategoryController::class,
        'updateSubcategory'
    ])->name('subcategories.update');

    Route::delete('/subcategories/{subcategory}', [
        CategoryController::class,
        'destroySubcategory'
    ])->name('subcategories.destroy');


    // =========================
    // News Management
    // =========================

    Route::get('/news', [
        NewsController::class,
        'index'
    ])->name('news.index');

    Route::get('/news/create', [
        NewsController::class,
        'create'
    ])->name('news.create');

    Route::post('/news', [
        NewsController::class,
        'store'
    ])->name('news.store');

    Route::get('/news/{news}/edit', [
        NewsController::class,
        'edit'
    ])->name('news.edit');

    Route::put('/news/{news}', [
        NewsController::class,
        'update'
    ])->name('news.update');

    Route::delete('/news/{news}', [
        NewsController::class,
        'destroy'
    ])->name('news.destroy');
});
