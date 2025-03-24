<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [ContactController::class, 'contact']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::middleware('auth')->group(function () {Route::get('/admin', [AuthController::class, 'admin']);});
Route::middleware('auth')->group(function () {Route::post('/admin', [AuthController::class, 'search']);});