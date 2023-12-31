<?php

use Azuriom\Plugin\CommunityAnalytics\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" and "admin" middleware groups. Now create something great!
|
*/
Route::middleware('can:communityanalytics.admin')->group(function () {
    Route::get('', [AdminController::class, 'index'])
        ->name('index');
    Route::post('regenerate-api-key', [AdminController::class, 'regenerateApiKey'])
        ->name('regenerate-api-key');
});
