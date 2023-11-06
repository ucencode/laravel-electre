<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ResultController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include __DIR__ . '/auth.php';

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller
    Route::resource('user', UserController::class)->except(['show']);

    Route::resource('alternative', AlternativeController::class)->except(['show']);

    Route::resource('criteria', CriteriaController::class)->except(['show']);

    Route::resource('score', ScoreController::class)->only(['index', 'create', 'store']);

    Route::get('result', [ResultController::class, 'index'])->name('result.index');
});
