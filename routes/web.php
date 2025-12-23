<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/chat', ChatController::class)->middleware('throttle:30,1')->name('chat.send');

/*
|--------------------------------------------------------------------------
| SEO ROUTES: SITEMAP & ROBOTS
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', function () {
    $staticUrls = collect([
        ['loc' => url('/')],
        ['loc' => route('products.index')],
    ]);

    $productUrls = Product::active()
        ->select('slug', 'updated_at')
        ->get()
        ->map(function (Product $product) {
            return [
                'loc' => route('products.show', $product->slug),
                'lastmod' => optional($product->updated_at)->toAtomString(),
            ];
        });

    $urls = $staticUrls->merge($productUrls)->all();

    return response()
        ->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
    ];

    if (app()->environment('production')) {
        $lines[] = 'Allow: /';
        $lines[] = 'Sitemap: ' . url('/sitemap.xml');
    } else {
        $lines[] = 'Disallow: /';
    }

    return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain']);
})->name('robots');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES - Hidden Login URL
|--------------------------------------------------------------------------
*/
Route::get('/pellucide-admin-secret', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/pellucide-admin-secret', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('products', AdminProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ])->except(['show']);

    Route::patch('/products/{product}/toggle-hot', [AdminProductController::class, 'toggleHot'])
        ->name('admin.products.toggle-hot');

    Route::patch('/products/{product}/toggle-active', [AdminProductController::class, 'toggleActive'])
        ->name('admin.products.toggle-active');
});
