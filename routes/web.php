<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SesiController::class, 'index'])->name('login');
Route::post('/', [SesiController::class, 'login']);

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', function () {
        return view('home');
    });
});

Route::middleware(['user'])->group(function () {
    Route::get('/user', function () {
        return view('userhome');
    });
});

Route::get('/register', [SesiController::class, 'formRegister'])->name('register');
Route::post('/register', [SesiController::class, 'register'])->name('register.action');
// Route::get('/admin', [AdminController::class, 'index']);
// Route::get('/user', [AdminController::class, 'index']);

Route::get('/logout', [SesiController::class, 'logout']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/sell', function () {
    return view('penjualan');
});

Route::get('/about', function () {
    return view('userabout');
});

Route::get('/sell', function () {
    return view('userpenjualan');
});

Route::get('/stock', function () {
    return view('inventaris');
});
Route::get('/checkout', function () {
    return view('keranjang');
});
Route::get('/report', function () {
    return view('laporan');
});
Route::get('/setting', function () {
    return view('pengaturan');
});
