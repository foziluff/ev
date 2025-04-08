<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\SendCodeController;
use App\Http\Controllers\Api\VerifyCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/token', [VerifyCodeController::class, 'devToken']);

Route::post('/send-code', [SendCodeController::class, 'sendCode'])
    ->middleware('throttle:1,1');
Route::post('/verify-code', [VerifyCodeController::class, 'verifyCode']);
//    ->middleware('throttle:3,1');


Route::get('/companies',        [CompanyController::class, 'index']);
Route::get('/companies/{id}',   [CompanyController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('companies', CompanyController::class);

});

Route::middleware(['auth:sanctum', 'superAdmin'])->group(function () {
    Route::post('/companies',           [CompanyController::class, 'store']);
    Route::patch('/companies/{id}',     [CompanyController::class, 'update']);
    Route::delete('/companies/{id}',    [CompanyController::class, 'destroy']);
});
