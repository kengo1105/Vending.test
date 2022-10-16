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
    //一覧
    Route::get('/products', [ProductController::class, 'showList'])->name('products.list');
    // 検索フォーム
Route::get('show', [ProductController::class, 'show'])->name('show');
// 検索結果
Route::get('searchproduct', [ProductController::class, 'search'])->name('searchproduct');
    //新規投稿
    Route::get('/products/create', [ProductController::class, 'createForm'])->name('create');
    Route::post('/products/create', [ProductController::class, 'store'])->name('product.store');
    //詳細画面
    Route::get('/products/{id}',[ProductController::class, 'showDetail'])->name('products.detail');
    //編集画面
    Route::get('/products/edit/{id}',[ProductController::class, 'showEdit'])->name('products.edit');
    Route::post('/products/update', [ProductController::class, 'update'])->name('update');
    //削除機能
    Route::post('/products/delete/{id}',[ProductController::class, 'destroy'])->name('product.destroy');
 });