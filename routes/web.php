<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController as H;
use App\Http\Controllers\CountryController as C;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [F::class, 'home'])->name('start')->middleware('roles:A|M|C');
Route::get('/hotel/{hotel}', [F::class, 'showHotel'])->name('show-hotel')->middleware('roles:A|M|C');
Route::post('/add-to-cart', [F::class, 'addToCart'])->name('add-to-cart')->middleware('roles:A|M|C');
Route::get('/cart', [F::class, 'cart'])->name('cart');
Route::post('/cart', [F::class, 'updateCart'])->name('update-cart');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order');


Route::prefix('admin/countries')->name('countries-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/edit/{country}', [C::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{country}', [C::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{country}', [C::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});

Route::prefix('admin/hotels')->name('hotels-')->group(function () {
    Route::get('/', [H::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/show/{hotel}', [H::class, 'show'])->name('show')->middleware('roles:A|M');
    Route::get('/pdf/{hotel}', [H::class, 'pdf'])->name('pdf')->middleware('roles:A|M');
    Route::get('/create', [H::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [H::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/edit/{hotel}', [H::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{hotel}', [H::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{hotel}', [H::class, 'destroy'])->name('delete')->middleware('roles:A|M');
    Route::get('/cat/{country}', [H::class, 'showCatHotels'])->name('show-cats-hotels')->middleware('roles:A|M');
});

Route::prefix('admin/orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
