<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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

Route::get('/about', function () {
    return 'about us page test';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::get('/product',[ProductController::class,'create'])->middleware('admin')->name('product.create');
//productCrudTest
Route::post('/product/create',[ProductController::class,'store'])->middleware('admin')->name('product.store');
Route::get('/product/{product:id}/edit',[ProductController::class,'edit'])->middleware('admin')->name('product.edit');
Route::put('product/{product:id}', [ProductController::class, 'update'])->middleware('admin')->name('.update');
Route::delete('product/{product:id}', [ProductController::class, 'destroy'])->middleware('admin')->name('product.destroy');
//end of productCrudTest
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
