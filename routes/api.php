<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\SendCodeController;
use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\VerifyCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/token', [VerifyCodeController::class, 'devToken']);

Route::post('/send-code', [SendCodeController::class, 'sendCode'])
    ->middleware('throttle:1,1');
Route::post('/verify-code', [VerifyCodeController::class, 'verifyCode']);
//    ->middleware('throttle:3,1');


Route::get('/companies',        [CompanyController::class, 'index']);
Route::get('/companies/{id}',   [CompanyController::class, 'show'])->where('id', '[0-9]+');

Route::get('/stations/{id}',     [StationController::class, 'show'])->where('id', '[0-9]+');
Route::get('/stations-radius',   [StationController::class, 'getInRadius']);
Route::get('/stations-search',   [StationController::class, 'search']);

Route::middleware(['auth:sanctum'])->group(function () {
    //
});

Route::middleware(['auth:sanctum', 'superAdmin'])->group(function () {

    Route::post('/companies',           [CompanyController::class, 'store']);
    Route::patch('/companies/{id}',     [CompanyController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/companies/{id}',    [CompanyController::class, 'destroy'])->where('id', '[0-9]+');

    Route::post('/stations',           [StationController::class, 'store']);
    Route::patch('/stations/{id}',     [StationController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/stations/{id}',    [StationController::class, 'destroy'])->where('id', '[0-9]+');

});
