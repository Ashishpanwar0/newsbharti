
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AuthController;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\News;


// =====================================================
// HOME PAGE
// =====================================================

Route::get('/', function () {

    $publishedNews = News::query()
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now());

    // Homepage breaking news
    $breakingNews = (clone $publishedNews)
        ->with('category')
        ->where('is_pinned', true)
        ->orderBy('pin_order')
        ->orderByDesc('published_at')
        ->take(8)
        ->get();

    // Homepage slider
    $sliderNews = (clone $publishedNews)
        ->with('category')
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->take(5)
        ->get();

    // Latest news
    $latestNews = (clone $publishedNews)
        ->with('category')
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->paginate(12);

    // Active categories and latest news in each category
    $homeCategories = Category::with(['news' => function ($query) {
        $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->take(4);
    }])
        ->where('is_active', true)
        ->orderBy('name')
        ->get();

    return view('welcome', compact(
        'breakingNews',
        'sliderNews',
        'latestNews',
        'homeCategories'
    ));

})->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



// =====================================================
// ADMIN DASHBOARD
// =====================================================

Route::get('/admin/dashboard', [
    DashboardController::class,
    'index'
])->middleware('auth')->name('admin.dashboard');


// =====================================================
// ADMIN PANEL
// =====================================================

Route::prefix('admin')->name('admin.')
    ->middleware('auth')
    ->group(function () {

    // Categories
    Route::get('/categories', [
        CategoryController::class,
        'index'
    ])->name('categories.index');

    Route::get('/categories/create', function () {
        $categories = Category::orderBy('name')->get();

        return view(
            'admin.categories-create',
            compact('categories')
        );
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


    // Subcategories
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


    // News CRUD
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


// =====================================================
// INDIVIDUAL NEWS DETAIL PAGE
// =====================================================

Route::get('/news/{news:slug}', function (News $news) {

    abort_unless(
        $news->status === 'published'
        && $news->published_at
        && $news->published_at->lte(now()),
        404
    );

    $news->load(['category', 'subcategory']);

    // Latest 12 published news, excluding current article
    $latestNews = News::with('category')
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('id', '!=', $news->id)
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->take(12)
        ->get();

    // Breaking news sidebar
    $breakingNews = News::with('category')
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('is_pinned', true)
        ->where('id', '!=', $news->id)
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->take(10)
        ->get();

    return view('news-show', compact(
        'news',
        'latestNews',
        'breakingNews'
    ));

})->name('news.show');


// =====================================================
// CATEGORY NEWS PAGE
// Example: /category/dehradun
// =====================================================

Route::get('/category/{category:slug}', function (Category $category) {

    abort_unless($category->is_active, 404);

    $news = News::with(['category', 'subcategory'])
        ->where('category_id', $category->id)
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->orderByDesc('is_pinned')
        ->orderBy('pin_order')
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->paginate(10);

    $breakingNews = News::with('category')
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('is_pinned', true)
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->take(10)
        ->get();

    return view('category-news', [
        'category' => $category,
        'subcategory' => null,
        'news' => $news,
        'breakingNews' => $breakingNews,
    ]);

})->name('category.show');


// =====================================================
// SUBCATEGORY NEWS PAGE
// Example: /category/dehradun/education
// =====================================================

Route::get('/category/{category:slug}/{subcategory:slug}', function (
    Category $category,
    Subcategory $subcategory
) {

    abort_unless($category->is_active, 404);

    abort_unless(
        (int) $subcategory->category_id === (int) $category->id,
        404
    );

    $news = News::with(['category', 'subcategory'])
        ->where('category_id', $category->id)
        ->where('subcategory_id', $subcategory->id)
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->orderByDesc('is_pinned')
        ->orderBy('pin_order')
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->paginate(10);

    $breakingNews = News::with('category')
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('is_pinned', true)
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->take(10)
        ->get();

    return view('category-news', [
        'category' => $category,
        'subcategory' => $subcategory,
        'news' => $news,
        'breakingNews' => $breakingNews,
    ]);

})->name('subcategory.show');


// =====================================================
// SEO: ROBOTS.TXT
// =====================================================

Route::get('/robots.txt', function () {

    $siteUrl = rtrim(config('app.url'), '/');

    $content = "User-agent: *\n"
        . "Allow: /\n"
        . "Disallow: /admin\n"
        . "Disallow: /admin/\n"
        . "Sitemap: {$siteUrl}/sitemap.xml\n";

    return response($content, 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');

});


// =====================================================
// SEO: XML SITEMAP
// =====================================================

Route::get('/sitemap.xml', function () {

    $news = News::query()
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->orderByDesc('published_at')
        ->get(['slug', 'updated_at', 'published_at']);

    $categories = Category::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['slug', 'updated_at']);

    $subcategories = Subcategory::with('category')
        ->where('is_active', true)
        ->whereHas('category', function ($query) {
            $query->where('is_active', true);
        })
        ->orderBy('name')
        ->get();

    return response()
        ->view('sitemap', compact(
            'news',
            'categories',
            'subcategories'
        ))
        ->header('Content-Type', 'application/xml; charset=UTF-8');

});
