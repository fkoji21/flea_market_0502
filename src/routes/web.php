<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
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
Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'show']);
Route::get('/sell', [ItemController::class, 'create'])->middleware('auth');
Route::post('/sell', [ItemController::class, 'store'])->middleware('auth');

/*ユーザー認証
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);*/

// ✅ 購入関連
Route::get('/purchase/{item_id}', [PurchaseController::class, 'showPurchaseForm'])->middleware('auth');
Route::post('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->middleware('auth');
Route::get('/purchase/address/{item_id}', [AddressController::class, 'showChangeForm'])->middleware('auth');
Route::post('/purchase/address/{item_id}', [AddressController::class, 'updateAddress'])->middleware('auth');

// ✅ ユーザープロフィール関連
Route::get('/mypage', [UserController::class, 'show'])->middleware('auth');
Route::get('/mypage/profile', [UserController::class, 'edit'])->middleware('auth');
Route::post('/mypage/profile', [UserController::class, 'update'])->middleware('auth');
