<?php

use App\Http\Controllers\WalletController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');

Route::put('/wallet/{id}', [WalletController::class, 'update']);

Route::post('/wallet', [WalletController::class, 'store']);

Route::get('/wallet/{id}', [WalletController::class, 'show']);

Route::delete('/wallet/{id}', [WalletController::class, 'destroy']);



