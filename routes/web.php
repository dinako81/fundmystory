<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController as S;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\CartController as CART;
use App\Http\Controllers\OrderController as O;

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

Route::prefix('tags')->name('tags-')->group(function () {
  Route::get('/', [T::class, 'index'])->name('index')->middleware('role:admin');
  Route::get('/list', [T::class, 'list'])->name('list')->middleware('role:admin');

  Route::post('/create', [T::class, 'create'])->name('create')->middleware('role:admin');

  Route::get('/show-modal/{tag}', [T::class, 'showModal'])->name('show-modal')->middleware('role:admin');
  Route::put('/update/{tag}', [T::class, 'update'])->name('update')->middleware('role:admin');

  Route::delete('/delete/{tag}', [T::class, 'destroy'])->name('delete')->middleware('role:admin');
});

Route::name('front-')->group(function () {
    Route::get('/', [F::class, 'index'])->name('index');
    Route::get('/story/{story}', [F::class, 'showStory'])->name('show-story');
    Route::get('/my-stories', [F::class, 'orders'])->name('orders')->middleware('role:admin|client');
    Route::put('/vote/{story}', [F::class, 'vote'])->name('vote')->middleware('role:admin|client');
    Route::put('/donors/{story}', [F::class, 'donors'])->name('donors')->middleware('role:admin|client');
    Route::get('/download/{story}', [F::class, 'download'])->name('download')->middleware('role:admin|client');
  Route::get('/gallery/{story}', [F::class, 'gallery'])->name('gallery')->middleware('role:admin|client');

});

Route::prefix('stories')->name('stories-')->group(function () {
    Route::get('/', [S::class, 'index'])->name('index')->middleware('role:admin|client');
    Route::get('/create', [S::class, 'create'])->name('create')->middleware('role:admin|client');
    Route::post('/create', [S::class, 'store'])->name('store')->middleware('role:admin|client');
    Route::get('/{story}', [S::class, 'show'])->name('show');
    Route::get('/edit/{story}', [S::class, 'edit'])->name('edit')->middleware('role:admin|client');
    Route::put('/edit/{story}', [S::class, 'update'])->name('update')->middleware('role:admin|client');
    Route::delete('/delete/{story}', [S::class, 'destroy'])->name('delete')->middleware('role:admin|client');
    Route::get('/funds/{story}', [S::class, 'editamount'])->name('editamoun')->middleware('role:admin|client');
    Route::put('/funds/{story}', [S::class, 'donateamount'])->name('donateamount')->middleware('role:admin|client');
    Route::delete('/delete-photo/{photo}', [S::class, 'destroyPhoto'])->name('delete-photo')->middleware('role:admin|client');
   

});

Route::prefix('orders')->name('orders-')->group(function () {
  Route::get('/', [O::class, 'index'])->name('index')->middleware('role:admin');
  Route::put('/status/{order}', [O::class, 'update'])->name('update')->middleware('role:admin');
});

Route::prefix('cart')->name('cart-')->group(function () {
  Route::put('/add', [CART::class, 'add'])->name('add');
  Route::put('/rem', [CART::class, 'rem'])->name('rem');
  Route::put('/update', [CART::class, 'update'])->name('update');
  Route::post('/buy', [CART::class, 'buy'])->name('buy');
  Route::get('/', [CART::class, 'showCart'])->name('show');
  Route::get('/mini-cart', [CART::class, 'miniCart'])->name('mini-cart');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');