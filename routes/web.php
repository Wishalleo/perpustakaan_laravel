<?php

use App\Http\Controllers\BookController;
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
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('stock-book',[BookController::class,'index'])->name('stock-book');
    
    Route::get('category',[CategoryController::class,'index'])->name('category');
    Route::get('add-category',[CategoryController::class,'create'])->name('add-category');
    Route::post('add-category',[CategoryController::class,'store'])->name('add-category');
    Route::get('update-category/{id}',[CategoryController::class,'edit'])->name('update-category');
    Route::post('update-category/{id}',[CategoryController::class,'update'])->name('update-category');
    Route::get('delete-category/{id}',[CategoryController::class,'destroy'])->name('delete-category');
});

require __DIR__.'/auth.php';
