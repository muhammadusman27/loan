<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/loans', [LoanController::class, 'index']);
Route::group(['prefix' => 'loan'], function () {
    Route::post('store', [LoanController::class, 'store']);
    Route::get('edit/{id}', [LoanController::class, 'edit']);
    Route::put('update/{id}', [LoanController::class, 'update']);
    Route::delete('delete/{id}', [LoanController::class, 'destroy']);
    Route::get('decline/{id}', [LoanController::class, 'decline']);
    Route::get('approve/{id}', [LoanController::class, 'approve']);
});

