<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StoryController as S;
use App\Http\Controllers\FrontController as F;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('front-')->group(function () {
    Route::get('/', [F::class, 'index'])->name('index');
    // Route::get('/category/{cat}', [F::class, 'catColors'])->name('cat-colors');
    // Route::get('/product/{product}', [F::class, 'showProduct'])->name('show-product');
    // Route::get('/my-orders', [F::class, 'orders'])->name('orders')->middleware('role:admin|client');
    // Route::get('/download/{order}', [F::class, 'download'])->name('download')->middleware('role:admin|client');
});

Route::prefix('stories')->name('stories-')->group(function () {

    Route::get('/', [S::class, 'index'])->name('index')->middleware('role:admin|client');

    // Route::get('/colors', [S::class, 'colors'])->name('colors')->middleware('role:admin');

    // Route::get('/color-name', [S::class, 'colorName'])->name('color-name')->middleware('role:admin');
    Route::get('/create', [S::class, 'create'])->name('create')->middleware('role:admin');
    Route::post('/create', [S::class, 'store'])->name('store')->middleware('role:admin');
    Route::get('/{story}', [S::class, 'show'])->name('show')->middleware('role:admin');
    Route::get('/edit/{story}', [S::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/edit/{story}', [S::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/delete/{story}', [S::class, 'destroy'])->name('delete')->middleware('role:admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');