<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\LineLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\socialite\GoogleLoginController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');




Route::prefix('login/{provider}')->where(['provider' => '(line|google|twitter|facebook|yahoo|github|slack|instagram)'])->group(function(){
    Route::get('/',         [LoginController::class, 'redirectToProvider']);
    Route::get('/callback', [LoginController::class, 'handleProviderCallback']);
});

// google
Route::get('/auth/redirect', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/callback', [GoogleLoginController::class, 'authGoogleCallback']);



// Route::get('/auth/redirect', 'App\Http\Controllers\socialite\GoogleLoginController@getGoogleAuth');
// Route::get('/login/callback','App\Http\Controllers\socialite\GoogleLoginController@authGoogleCallback');

/*
Route::get('/linelogin', 'App\Http\Controllers\LineLoginController@lineLogin')->name('linelogin');
Route::get('/login/line/callback', 'App\Http\Controllers\LineLoginController@callback')->name('callback');

Route::get('/line/redirect', [LoginController::class, 'redirectToProvider'])->name('line.redirect');
Route::get('/line/callback', [LoginController::class, 'handleProviderCallback'])->name('line.callback');
*/



