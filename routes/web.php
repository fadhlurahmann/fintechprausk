<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logoutmanual', [App\Http\Controllers\HomeController::class, 'logoutmanual']);

Route::post('/addToCart', [TransactionController::class, 'addToCart'])->name('addToCart');
Route::post('/payNow', [TransactionController::class, 'payNow'])->name('payNow');
Route::post('TopUpNow', [WalletController::class, 'TopUpNow'])->name('TopUpNow');
Route::get('/download/{order_id}', [TransactionController::class, 'download'])->name('download');
Route::post('request_topup', [WalletController::class, 'request_topup'])->name('request_topup');
