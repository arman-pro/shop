<?php

/**
 * Admin Dashboard Functionality
 */

use App\Http\Controllers\admin\GeneralController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->middleware('admin');

    // products 
    Route::get('/products', [ProductController::class, 'index']);
    // create new product
    Route::get('/products/create', [ProductController::class, 'create']);
    // product store
    Route::post('/products/create', [ProductController::class, 'store'])->name('product.store');
    // product show and edit
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.admin.show');
    // product update
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    // product delete 
    Route::delete('/product/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    // product print
    Route::get('/product/{id}/print', [ProductController::class, 'print'])->name("product.print");

    /** 
     * User Module 
     */
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}/show', [UserController::class, 'show'])->name("user.show");
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}/save', [UserController::class, 'save'])->name('user.save');
    /**
     * Order Module
     */
    Route::get('/orders', [OrderController::class, 'index'])->name('order');
    Route::get('/orders/{id}/show', [OrderController::class, 'show'])->name('admin.order.show');
    Route::put('/orders/{id}/status', [OrderController::class, 'saveStatus'])->name('admin.order.status');

    // general site setting
    Route::get('/general', [GeneralController::class, 'index'])->name('admin.general');
    Route::post('/general', [GeneralController::class, 'store'])->name('admin.general.store');

    // login
    Route::get('/login', [LoginController::class, 'index']);
    // login store
    Route::post('/login', [LoginController::class, 'login']);
    // logout
    Route::get('/logout', [LoginController::class, 'logout']);
});
