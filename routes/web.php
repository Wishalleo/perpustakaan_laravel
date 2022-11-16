<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('book', [BookController::class, 'index'])->name('book');
    Route::get('add-book', [BookController::class, 'create'])->name('add-book');
    Route::post('add-book', [BookController::class, 'store'])->name('add-book');
    Route::get('update-book/{id}', [BookController::class, 'edit'])->name('update-book');
    Route::post('update-book/{id}', [BookController::class, 'update'])->name('update-book');
    Route::get('delete-book/{id}', [BookController::class, 'destroy'])->name('delete-book');

    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('add-category', [CategoryController::class, 'store'])->name('add-category');
    Route::get('update-category/{id}', [CategoryController::class, 'edit'])->name('update-category');
    Route::post('update-category/{id}', [CategoryController::class, 'update'])->name('update-category');
    Route::get('delete-category/{id}', [CategoryController::class, 'destroy'])->name('delete-category');

    Route::get('borrow', [BorrowController::class, 'index'])->name('borrow');
    Route::get('cart', [BorrowController::class, 'cart'])->name('cart');
    Route::post('check-member', [BorrowController::class, 'checkMember'])->name('check-member');
    Route::post('add-cart', [BorrowController::class, 'addCart'])->name('add-cart');
    Route::get('delete-cart/{id}', [BorrowController::class, 'deleteCart'])->name('delete-cart');
    Route::post('add-borrow', [BorrowController::class, 'addBorrow'])->name('add-borrow');
});

require __DIR__ . '/auth.php';
