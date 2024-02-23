<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/payments', [PaymentController::class, 'createPayment']);
    Route::get('/payments', [PaymentController::class, 'listPayments']);
    Route::get('/payments/{id}', [PaymentController::class, 'viewPayment']);
    Route::patch('/payments/{id}', [PaymentController::class, 'confirmPayment']);
    Route::delete('/payments/{id}', [PaymentController::class, 'cancelPayment']);
});
