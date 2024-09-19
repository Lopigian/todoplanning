<?php

use App\Http\Controllers\ProviderController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/providers', [ProviderController::class, 'index'])->name('providers.index');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/assigned-list', [TaskController::class, 'showAssignments'])->name('tasks.showAssignments');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
