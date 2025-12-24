<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ClientTypeController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DurationTypeController;
use App\Http\Controllers\IpotekaTypeController;
use App\Http\Controllers\LessorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PriceCategoryController;
use App\Http\Controllers\PropertyConditionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertySeekingController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\TradingTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/telegram/webhook', [ApplicationController::class, 'webhook']);

