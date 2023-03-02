<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\configuratorController;
use App\Http\Controllers\moduleController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\orderController;
use App\Models\Configurator;


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

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group( function() {
    //wyswietlanie zawartosci-configurator
    Route::get('/configurator', [configuratorController::class, 'index'])->name('configurator');

    //wyswietlenie modułu
    Route::get('configurator/module/{id}', [moduleController::class, 'index'])//{id} pobieram id z URL
    ->where('id', '[0-9]+')//sprawdzam czy id jest cyfrą całkowitą
    ->missing(function (Request $request) {//jeżeli id w URL nie ma w bazie zwróć stronę home
        return Redirect::route('home');
    });

    //dodanie do koszyka
    Route::post('/addToCart', [cartController::class, 'addToCart'])->name('addToCart');

    //wyswietlenie koszyka
    Route::get('/cart', [cartController::class, 'index'])->name('cart');

    //aktualizacja ilości produktu w koszyku
    Route::patch('update-cart', [cartController::class, 'update'])->name('update.cart');

    //usuwanie produktu z koszyka
    Route::delete('remove-from-cart', [cartController::class, 'remove'])->name('remove.from.cart');

    //zniszczenie sesji koszyka
    Route::get('/cart/destroyCart', [cartController::class, 'destroy']);

    //podsumowanie zamówienia
    Route::get('/orderSummary', [orderController::class, 'index']);

    //złożenie zamówienia
    Route::post('/addOrder', [orderController::class, 'addOrder']);

    //kupon rabatowy
    Route::post('/discount', [orderController::class, 'discount']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
