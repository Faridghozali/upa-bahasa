<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\TransactionController;
use App\Http\Controllers\GradeSummaryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Transaction
Route::post('/transactions/{transactionId}/callback', TransactionController::class . '@callback')->name('api.transaction.callback');
Route::put('/transactions/{transactionId}/payment-success', TransactionController::class . '@paymentSuccess')->name('api.transaction.payment-success');

// API Grade Summary
Route::get('/grades/summary', [GradeSummaryController::class, 'perMonth'])->name('api.grades.summary');
