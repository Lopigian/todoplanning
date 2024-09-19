<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProvidersController;

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


Route::controller(ProvidersController::class)->group(function () {
    Route::post('/providers', 'create')->name('providers.create');
    Route::put('/providers', 'update')->name('providers.update');
    Route::delete('/providers/{id}', 'delete')->name('providers.delete');
    Route::get('/providers/all', 'getAll')->name('providers.getAll');
    Route::get('/providers/{id}', 'getById')->name('providers.getById');
});
