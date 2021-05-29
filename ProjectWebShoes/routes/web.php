<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\SendMailController;



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
//     return view('home.home');
// });

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//discount
Route::get('/discount', [DiscountController::class, 'discount'])->name('discount');

//login
Route::get('login-user', [LoginController::class, 'login'])->name('login');
Route::post('login-user', [LoginController::class, 'postLogin']);
//logout
Route::get('logout', [LoginController::class, 'logOut'])->name('logout');

//cart
Route::get('/cart', [DetailController::class, 'cart'])->name('cart');

//Check out
Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('checkouts.checkout');
Route::post('/cart/checkout-cart', [CheckoutController::class, 'checkout'])->name('post.checkout');
Route::get('/cart/checkout/thank-you', [CheckoutController::class, 'thank'])->name('checkouts.thank');


//update-cart
Route::get('/update-cart', [DetailController::class, 'updateCart'])->name('update-cart');
Route::get('/delete-cart', [DetailController::class, 'deleteCart'])->name('delete-cart');


//Category
Route::get('/{slug}', [CategoryController::class, 'index'])->name('categories.category');

//Sắp xếp giá category
Route::get('/{slug}/price-asc', [CategoryController::class, 'price_asc'])->name('price-asc');
Route::get('/{slug}/price-desc', [CategoryController::class, 'price_desc'])->name('price-desc');

//Detail
Route::get('/{id}/{name}', [DetailController::class, 'index'])->name('categories.detail');

//Add-to-cart
Route::prefix('product')->group(function () {
	Route::get('/add-cart/{id}', [DetailController::class, 'addCart'])->name('add-cart');
	Route::get('/add-to-cart/{id}', [DetailController::class, 'addToCart'])->name('add-to-cart');
});


