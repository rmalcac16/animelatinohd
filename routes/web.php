<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\AppController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnimeController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ServerController;
use App\Http\Controllers\Admin\PlayerController;
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

Route::name('web.')->group(function (){
    Route::get('/', [AppController::class, 'getHome'])->name('home');
    Route::get('ver/{slug}/{number}', [AppController::class, 'getEpisode'])->name('episode');
    Route::get('anime/{anime}', [AppController::class, 'getAnime'])->name('anime');
    Route::prefix('animes')->name('animes.')->group(function (){
        Route::get('/', [AppController::class, 'getAnimesList'])->name('index');
        Route::get('/latino', [AppController::class, 'getAnimesLatinoList'])->name('latino');
        Route::get('/mas-vistos', [AppController::class, 'getAnimesMoreViewList'])->name('moreview');
        Route::get('/populares', [AppController::class, 'getAnimesPopularList'])->name('popular');
        Route::get('/calendario', [AppController::class, 'getCalendarAnimes'])->name('calendar');
    });
    Route::get('/video/{id}', [AppController::class, 'showVideo'])->name('video');
});


// Auth::routes();

// Route::middleware('authadmin')->prefix('admin')->name('admin.')->group(function (){
//     Route::get('/', [DashboardController::class, 'index'])->name('index');
//     Route::resource('animes', AnimeController::class);
//     Route::resource('genres', GenreController::class);
//     Route::resource('servers', ServerController::class);
//     //Route::get('animes-generate', [AnimeController::class, 'generate'])->name('animes.generate');
//     Route::name('animes.')->prefix('animes')->group(function () {
//         Route::get('datatable/list', [AnimeController::class, 'list'])->name('datatable.list');
//         Route::resource('{anime_id}/episodes', EpisodeController::class);
//         //Route::get('{anime_id}/episodes-remote', [EpisodeController::class, 'remote'])->name('episodes.remote');
//         //Route::get('{anime_id}/episodes-generate', [EpisodeController::class, 'generate'])->name('episodes.generate');
//         //Route::get('{anime_id}/players-generate', [EpisodeController::class, 'generatePlayers'])->name('episodes.generatePlayers');
//         //Route::post('{anime_id}/episodes-alldelete', [EpisodeController::class, 'allDelete'])->name('episodes.allDelete');
//         Route::name('episodes.')->prefix('{anime_id}/episodes')->group(function () {
//             Route::resource('{episode_id}/players', PlayerController::class);
//             //Route::post('generate/storePlayers', [PlayerController::class, 'storePlayers'])->name('players.storePlayers');
//             //Route::post('delete/players-allDelete', [PlayerController::class, 'allDeletePlayers'])->name('players.allDeletePlayers');
//         });
//     });
// });
