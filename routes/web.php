<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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

Route::post('/payments', [PaymentController::class, 'createPayment']);
Route::get('/payments', [PaymentController::class, 'listPayments']);
Route::get('/payments/{id}', [PaymentController::class, 'viewPayment']);
Route::patch('/payments/{id}', [PaymentController::class, 'confirmPayment']);
Route::delete('/payments/{id}', [PaymentController::class, 'cancelPayment']);
