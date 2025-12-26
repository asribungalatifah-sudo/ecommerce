<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransNotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', function () {
    return view('flexy');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/sapa/{nama}', function ($nama) {
    return "Hallo, $nama! Selamat datang di toko online kami.";
});

Route::get('/kategori/{nama?}', function ($nama = 'semua') {
    return "Menampilkan kategori: $nama";
});

Route::get('/produk/{id}', function ($id) {
    return "Menampilkan produk dengan ID: $id";
})->name ('detail.produk');


Auth::routes();

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // /admin/dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
         Route::resource('/products', AdminProductController::class);
        Route::resource('/categories', AdminCategoryController::class);

    });

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('auth.google');
    Route::get('auth/google/callback', 'callback');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.destroy');

});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/product/{slug}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/catalog/search', [CatalogController::class, 'search'])->name('catalog.search');
Route::get('/catalog/category/{category}', [CatalogController::class, 'category'])->name('catalog.category');



Route::middleware('auth')->group(function () {
    // Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Wishlist
    Route::post('/wishlist/{product}', [WishlistController::class, 'toggle'])
    ->middleware('auth')
    ->name('wishlist.toggle');

Route::get('/wishlist', [WishlistController::class, 'index'])
    ->middleware('auth')
    ->name('wishlist.index');

Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])
    ->middleware('auth')
    ->name('wishlist.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');


    // Pesanan Saya
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Produk CRUD
    Route::resource('products', AdminProductController::class);

    // Kategori CRUD
    Route::resource('categories', AdminCategoryController::class);

    // Manajemen Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

   //order
   Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Kategori
    Route::resource('categories', CategoryController::class)->except(['show']); // Kategori biasanya tidak butuh show detail page

    // Produk
    Route::resource('products', ProductController::class);

    // Route tambahan untuk AJAX Image Handling (jika diperlukan)
    // ...
});

Auth::routes();

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Auth::routes();

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
    });

// routes/web.php (HAPUS SETELAH TESTING!)

use App\Services\MidtransService;

Route::get('/debug-midtrans', function () {
    // Cek apakah config terbaca
    $config = [
        'merchant_id'   => config('midtrans.merchant_id'),
        'client_key'    => config('midtrans.client_key'),
        'server_key'    => config('midtrans.server_key') ? '***SET***' : 'NOT SET',
        'is_production' => config('midtrans.is_production'),
    ];

    // Test buat dummy token
    try {
        $service = new MidtransService();

        // Buat dummy order untuk testing
        $dummyOrder = new \App\Models\Order();
        $dummyOrder->order_number = 'TEST-' . time();
        $dummyOrder->total_amount = 10000;
        $dummyOrder->shipping_cost = 0;
        $dummyOrder->shipping_name = 'Test User';
        $dummyOrder->shipping_phone = '08123456789';
        $dummyOrder->shipping_address = 'Jl. Test No. 123';
        $dummyOrder->user = (object) [
            'name'  => 'Tester',
            'email' => 'test@example.com',
            'phone' => '08123456789',
        ];
        // Dummy items
        $dummyOrder->items = collect([
            (object) [
                'product_id'   => 1,
                'product_name' => 'Produk Test',
                'price'        => 10000,
                'quantity'     => 1,
            ],
        ]);

        $token = $service->createSnapToken($dummyOrder);

        return response()->json([
            'status'  => 'SUCCESS',
            'message' => 'Berhasil terhubung ke Midtrans!',
            'config'  => $config,
            'token'   => $token,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'ERROR',
            'message' => $e->getMessage(),
            'config'  => $config,
        ], 500);
    }
});

// routes/web.php
Route::middleware('auth')->group(function () {
    // ... routes lainnya

    // Payment Routes
    Route::get('/orders/{order}/pay', [PaymentController::class, 'show'])
        ->name('orders.pay');
    Route::get('/orders/{order}/success', [PaymentController::class, 'success'])
        ->name('orders.success');
    Route::get('/orders/{order}/pending', [PaymentController::class, 'pending'])
        ->name('orders.pending');
    Route::post('midtrans/notification', [MidtransNotificationController::class, 'handle'])
    ->name('midtrans.notification');
});

