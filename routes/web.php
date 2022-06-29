<?php

use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);
Route::resource('register', RegisterController::class)->middleware('guest');
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::get('/home', function () {
    return view('user.home', [
        "title" => "home"
    ]);
});

Route::get('/about', function () {
    return view('user.about', [
        "title" => "about"
    ]);
});

Route::get('/services', function () {
    return view(
        'user.services',
        [
            "title" => "services"
        ]
    );
});

Route::resource('apply', ApplyController::class)->middleware('auth');

Route::get('/contact', function () {
    return view('user.contact', [
        "title" => "contact"
    ]);
});

Route::resource('account', AccountController::class)->middleware('auth');
Route::post('change', [AccountController::class, 'change'])->name('change')->middleware('auth');

Route::get('/apply/simpanan', function () {
    return view('user.simpanan');
});

Route::get('penarikan', [ApplyController::class, 'penarikan'])->name('penarikan')->middleware('auth');

Route::resource('anggota', AnggotaController::class)->middleware('auth');

Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');

Route::get('/angsuran', function () {
    return view('admin.angsuran', []);
});

Route::get('/angsuran/edit', function () {
    return view('admin.edit-angsuran', []);
});


Route::get('/pengambilan', function () {
    return view('admin.pengambilan', []);
});

Route::get('/pengambilan/edit', function () {
    return view('admin.edit-pengambilan', []);
});

Route::get('/simpanan', function () {
    return view('admin.simpanan', []);
});

Route::get('/simpanan/edit', function () {
    return view('admin.edit-simpanan', []);
});
