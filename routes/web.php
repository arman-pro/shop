<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('/');

// serach product
Route::get('/search', [SearchController::class, 'index'])->name('search');

// product show
Route::get('/product/{id}/{slug}', [ProductController::class, 'show'])->name('product.show');

// category
Route::get('/category/{id}/{name}', [CategoryController::class, 'index'])->name('category.show');

// user route
Route::get('/user/login', [LoginController::class, 'index'])->name('user.login');
Route::post('/user/login', [LoginController::class, 'store'])->name('user.login');
Route::get('/user/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::get('/user/registration', [RegistrationController::class, 'index'])->name('user.registration');
Route::post('/user/registration', [RegistrationController::class, 'store'])->name('user.registration');

// add product to cart
Route::get('/cart/{id}/', [CartController::class, 'store'])->name('cart.store');
// show cart item
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// remove a cart item
Route::get('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');
// clear cart
Route::get('/destroy/cart', [CartController::class, 'clear'])->name('destroy.cart');
// Review save
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
// product checkout
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
// order place
Route::post('/order', [OrderController::class, 'store'])->name('order.store');



include_once "admin.php";
