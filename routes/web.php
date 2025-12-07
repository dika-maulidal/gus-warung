<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderManagementController; // 💡 Pastikan Anda menggunakan nama controller ini!


/*
|--------------------------------------------------------------------------
| Route Otentikasi & Public
|--------------------------------------------------------------------------
| ... (Tidak berubah)
*/

// Halaman utama / Login (Routes Teman)
Route::get('/', [SesiController::class, 'index'])->name('login');
Route::post('/', [SesiController::class, 'login']);
Route::get('/register', [SesiController::class, 'formRegister'])->name('register');
Route::post('/register', [SesiController::class, 'register'])->name('register.action');
Route::get('/logout', [SesiController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Route Admin (Memerlukan Middleware 'admin')
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->group(function () {

    // 1. Dashboard Admin
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // 2. Manajemen Produk (CRUD Products)
    Route::prefix('admin/products')->name('admin.products.')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{menu}/edit', 'edit')->name('edit');
        Route::put('/{menu}', 'update')->name('update');
        Route::delete('/{menu}', 'destroy')->name('destroy');
    });

    // 3. Manajemen Stok (Perbaiki URL prefix untuk konsistensi)
    Route::get('/admin/stock', function () {
        return view('inventaris'); // Ganti dengan controller jika ada logika data
    })->name('admin.stock.index');

    // 4. ✨ ROUTE BARU: Kelola Pesanan & Pembayaran (Menggunakan Resource)
    Route::resource('admin/orders', App\Http\Controllers\Admin\OrderManagementController::class)
        ->only(['index', 'show'])
        ->names('admin.orders');

    Route::put('admin/orders/{order}/status', [\App\Http\Controllers\Admin\OrderManagementController::class, 'updateStatus'])
        ->name('admin.orders.update_status');
    // 5. Rute Admin Lain
    Route::get('/admin/report', function () {
        return view('laporan');
    });
    Route::get('/admin/setting', function () {
        return view('pengaturan');
    });
});


/*
|--------------------------------------------------------------------------
| Route User (Memerlukan Middleware 'user')
|--------------------------------------------------------------------------
| ... (Tidak berubah)
*/
Route::middleware(['user'])->group(function () {

    Route::get('/user', function () {
        return view('userhome');
    })->name('user.dashboard');

    Route::get('/sell', [MenuController::class, 'penjualan'])->name('user.sell');
    Route::get('/about', function () {
        return view('userabout');
    });
    Route::get('/checkout', function () {
        return view('keranjang');
    })->name('user.checkout');
    Route::post('/checkout/place-order', [\App\Http\Controllers\OrderController::class, 'placeOrder'])->name('user.place_order');
});

/*
|--------------------------------------------------------------------------
| Route Public / General
|--------------------------------------------------------------------------
| ... (Tidak berubah)
*/
Route::get('/about', function () {
    return view('about');
});