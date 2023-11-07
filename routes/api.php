<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AppController;

use Illuminate\Support\Facades\Auth;

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

// Rutas de Auth Sanctum(Bearer Token)

Route::prefix('auth')->name('auth.')->group(function (){
    Route::post('/login', [AuthController::class, 'loginUser'])->name('login');
    Route::post('/register', [AuthController::class, 'RegisterUser'])->name('register');
    Route::middleware('apiMd')->group(function (){
        Route::post('/user', [AuthController::class, 'getUser'])->name('user');
        Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');
        Route::post('/logout-all', [AuthController::class, 'logoutAllDeleteTokens'])->name('logoutAllSesions');
    });
});


// Rutas API con Auth Sanctum(Bearer Token)

Route::middleware('apiMd')->prefix('app')->name('app.')->group(function (){
    Route::post('/releases', [AppController::class, 'getDataHome'])->name('home');
    Route::post('/anime/{slug}', [AppController::class, 'getDataAnime'])->name('anime');
    Route::post('/animes', [AppController::class, 'getAnimes'])->name('animes');
});