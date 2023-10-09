<?php

use Azuriom\Plugin\CommunityAnalytics\Controllers\Api\StoreController;
use Azuriom\Plugin\CommunityAnalytics\Middleware\AuthenticatePluginMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => AuthenticatePluginMiddleware::class], function () {
    Route::get('', [StoreController::class, "info"])->name('info');
    Route::get("packages", [StoreController::class, "packages"])->name('packages');
    Route::get("payments", [StoreController::class, "payments"])->name('payments');
});
