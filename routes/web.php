<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/facebook/redirect', [App\Http\Controllers\SocialiteController::class, 'redirectToProvider'])->name('login.facebook');
 
Route::get('/auth/facebook/callback', [App\Http\Controllers\SocialiteController::class, 'handleProviderCallback']);

Route::get('/auth/twitter/redirect', [App\Http\Controllers\SocialiteController::class, 'redirectToTwitterProvider'])->name('login.twitter');
 
Route::get('/auth/twitter/callback', [App\Http\Controllers\SocialiteController::class, 'handleTwitterProviderCallback']);

Route::get('/auth/google/redirect', [App\Http\Controllers\SocialiteController::class, 'redirectToGoogleProvider'])->name('login.google');
 
Route::get('/auth/google/callback', [App\Http\Controllers\SocialiteController::class, 'handleGoogleProviderCallback']);
