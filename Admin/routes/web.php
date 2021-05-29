<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OrderController;

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
Route::get('/admin',[AdminController::class, 'loginAdmin']);
Route::post('/admin',[AdminController::class, 'postLoginAdmin']);

Route::get('/home', function(){
	return view('home');
});

// 
// 
Route::prefix('admin')->group(function () {
	//Category
	Route::prefix('categories')->group(function () {
	    Route::get('/', [CategoryController::class , 'index'])->name('categories.index')->middleware('can:category-list');
	    Route::get('/create', [CategoryController::class , 'create'])->name('categories.create')->middleware('can:category-add');
	    Route::post('/store', [CategoryController::class , 'store'])->name('categories.store');
	    Route::get('/edit/{id}', [CategoryController::class , 'edit'])->name('categories.edit')->middleware('can:category-edit');
	    Route::post('/update/{id}', [CategoryController::class , 'update'])->name('categories.update');
	    Route::get('/delete/{id}', [CategoryController::class , 'delete'])->name('categories.delete')->middleware('can:category-delete');
	});
	// ->middleware('can:product-list')
	//Product
	Route::prefix('product')->group(function () {
	    Route::get('/', [ProductController::class , 'index'])->name('product.index')->middleware('can:product-list');
	    Route::get('/image-detail/{id}', [ProductController::class , 'detailImage'])->name('product.detailImage');
	    Route::get('/create', [ProductController::class , 'create'])->name('product.create')->middleware('can:product-add');
	    Route::post('/store', [ProductController::class , 'store'])->name('product.store');
	    Route::get('/edit/{id}', [ProductController::class , 'edit'])->name('product.edit')->middleware('can:product-edit');
	    Route::post('/update/{id}', [ProductController::class , 'update'])->name('product.update');
	    Route::get('/delete/{id}', [ProductController::class , 'delete'])->name('product.delete')->middleware('can:product-delete');
	});

	Route::prefix('discount')->group(function () {
	    Route::get('/', [DiscountController::class , 'index'])->name('discount.index');
	    Route::get('/create', [DiscountController::class , 'create'])->name('discount.create');
	    Route::post('/store', [DiscountController::class , 'store'])->name('discount.store');
	    // Route::get('/edit/{id}', [DiscountController::class , 'edit'])->name('discount.edit');
	    // Route::post('/update/{id}', [DiscountController::class , 'update'])->name('discount.update');
	    // Route::get('/delete/{id}', [DiscountController::class , 'delete'])->name('discount.delete');
	});	

	Route::prefix('order')->group(function () {
	    Route::get('/', [OrderController::class , 'index'])->name('order.index')->middleware('can:order-list');
	    Route::get('/detail/{id}', [OrderController::class , 'detail'])->name('order.detail');
	    Route::get('/delete/{id}', [OrderController::class , 'delete'])->name('order.delete')->middleware('can:order-delete');
	});	
});


//Phân quyền

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class , 'index'])->name('user.index')->middleware('can:acount-list');
    Route::get('/create', [UserController::class , 'create'])->name('user.create')->middleware('can:acount-add');
    Route::post('/store', [UserController::class , 'store'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class , 'edit'])->name('user.edit');//->middleware('can:acount-edit')
    Route::post('/update/{id}', [UserController::class , 'update'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class , 'delete'])->name('user.delete')->middleware('can:acount-delete');
});
Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class , 'index'])->name('roles.index')->middleware('can:role-list');
    Route::get('/create', [RoleController::class , 'create'])->name('roles.create')->middleware('can:role-add');
    Route::post('/store', [RoleController::class , 'store'])->name('roles.store');
    Route::get('/edit/{id}', [RoleController::class , 'edit'])->name('roles.edit')->middleware('can:role-edit');
    Route::post('/update/{id}', [RoleController::class , 'update'])->name('roles.update');
    Route::get('/delete/{id}', [RoleController::class , 'delete'])->name('roles.delete')->middleware('can:role-delete');
});

Route::prefix('permissions')->group(function () {
    Route::get('/create', [PermissionController::class , 'create'])->name('permissions.create')->middleware('can:role-premisson-add');
    Route::post('/store', [PermissionController::class , 'store'])->name('permissions.store');
});