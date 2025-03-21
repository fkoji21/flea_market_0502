<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

// ✅ 商品関連
Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{item_id}', [ItemController::class, 'show']);
Route::get('/sell', [ItemController::class, 'create'])->middleware('auth', 'verified');
Route::post('/sell', [ItemController::class, 'store'])->middleware('auth', 'verified');

// ✅ 購入関連
Route::get('/purchase/{item_id}', [PurchaseController::class, 'showPurchaseForm'])->middleware('auth', 'verified');
Route::post('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->middleware('auth', 'verified');
Route::get('/purchase/address/{item_id}', [AddressController::class, 'showChangeForm'])->middleware('auth', 'verified');
Route::post('/purchase/address/{item_id}', [AddressController::class, 'updateAddress'])->middleware('auth', 'verified');

// ✅ ユーザープロフィール関連
Route::get('/mypage', [UserController::class, 'show'])->middleware('auth', 'verified');
Route::get('/mypage/profile', [UserController::class, 'edit'])->middleware('auth', 'verified');
Route::post('/mypage/profile', [UserController::class, 'update'])->middleware('auth', 'verified');

// いいね・コメント
Route::post('/item/{item}/like', [ItemController::class, 'like'])->name('item.like')->middleware(['auth', 'verified']);
Route::post('/item/{item}/unlike', [ItemController::class, 'unlike'])->name('item.unlike')->middleware(['auth', 'verified']);
Route::post('/items/{item}/comment', [ItemController::class, 'addComment'])->name('item.comment')->middleware(['auth', 'verified']);

// メール認証通知画面
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// メール認証リンクを押したときの処理
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mypage'); // 認証完了後に飛ばしたいページ
})->middleware(['auth', 'signed'])->name('verification.verify');

// 認証メール再送信処理
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('resent', true);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/register', [RegisterController::class, 'store']);
Route::get('/mylist', [ItemController::class, 'mylist'])->middleware(['auth', 'verified'])->name('items.mylist');

Route::get('/checkout/{item_id}', [StripeController::class, 'checkout'])->middleware(['auth', 'verified'])->name('checkout');
Route::post('/payment', [StripeController::class, 'payment'])->middleware(['auth', 'verified'])->name('payment');
Route::get('/payment/success', [StripeController::class, 'paymentSuccess'])->name('payment.success');
