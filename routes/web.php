<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(ProductController::class)->group(function() {

    Route::get('/products', [ProductController::class, 'showList'])->name('products.list');
    Route::get('/', [ProductController::class, 'index'])->name('item.index');
    Route::get('/products/create', [ProductController::class, 'createForm'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('item.store');
    Route::post('/upload', [ProductController::class, 'upload'])->name('store');
    Route::get('/', 'showList')->name('form');
    Route::get('/regist',[ProductController::class, 'showRegistForm']);
    // 検索フォーム
    Route::get('show', [ProductController::class, 'show'])->name('show');
    // 検索結果
    Route::get('searchproduct', [ProductController::class, 'search'])->name('searchproduct');
 });