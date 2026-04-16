<?php

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

// マイページ
Route::get('/mypage', [ProductsController::class, 'mypage'])->name('mypage');

// ログアウト
Route::post('/logout', function () {Auth::logout();return redirect('/');})->name('logout');

// 商品一覧
Route::get('/products', [ProductsController::class, 'showProducts'])->name('products');

// 検索処理
Route::get('/search', [ProductsController::class, 'search'])->name('search');

// 新規登録画面
Route::get('/registration', [ProductsController::class, 'registration'])->name('registration');
// 新規登録処理
Route::post('/products', [ProductsController::class, 'products'])->name('products');

// 詳細画面
Route::get('/products/{id}', [ProductsController::class, 'show'])->name('detail_products');

// いいね追加
Route::post('/products/{product}/like', [LikeController::class, 'likeProduct'])->middleware('auth');

// いいね削除
Route::delete('/products/{product}/like', [LikeController::class, 'unlikeProduct'])->middleware('auth');

// 出品商品詳細画面
Route::get('/mypage/products/{id}', [ProductsController::class, 'showMyItem'])->name('detail_item');

// 商品削除
Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('destroy');

// 購入画面
Route::get('/products/{product}/purchase',[SalesController::class, 'show'])->name('product.purchase.form');
// 購入処理
Route::post('/products/{product}/purchase', [SalesController::class, 'purchase'])->name('product.purchase');

// 更新画面表示
Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('item');
// 更新処理
Route::put('/products/{id}', [ProductsController::class, 'update'])->name('item.update');

// アカウント編集画面
Route::get('/account', [AccountController::class, 'edit'])->name('account');

Route::post('/account', [AccountController::class, 'update'])->name('account.update');

// 問い合わせフォーム画面
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');

// 問い合わせフォーム送信
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Auth::routes();
