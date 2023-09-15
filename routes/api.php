<?php

use App\Http\Controllers\Api\V1\Auth;
use App\Http\Controllers\Api\V1\CheckListController;
use App\Http\Controllers\Api\V1\CheckListItemController;
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

Route::post('auth/register', Auth\RegisterController::class);
Route::post('auth/login', Auth\LoginController::class);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('checklist', CheckListController::class)->except(['show', 'update']);
    Route::controller(CheckListItemController::class)->group(function () {
        Route::get('checklist/{checklist}/item', 'index');
        Route::post('checklist/{checklist}/item', 'store');
        Route::get('checklist/{checklist}/item/{checklistItem}', 'show');
        Route::put('checklist/{checklist}/item/{checklistItem}', 'update');
        Route::put('checklist/{checklist}/item/rename/{checklistItem}', 'rename');
        Route::delete('checklist/{checklist}/item/{checklistItem}', 'destroy');
    });

});
