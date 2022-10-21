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

Route::get('/auth/{provider}/redirect', [App\Http\Controllers\SocialiteController::class, 'redirectToProvider']);
 
Route::get('/auth/{provider}/callback', [App\Http\Controllers\SocialiteController::class, 'handleProviderCallback']);

// Admin routes
Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/locations', [App\Http\Controllers\LocationController::class, 'index']);
    Route::post('/locations', [App\Http\Controllers\LocationController::class, 'store']);
    Route::delete('/locations/{location}', [App\Http\Controllers\LocationController::class, 'destroy']);
    Route::get('/locations/{location}', [App\Http\Controllers\LocationController::class, 'edit']);
    Route::put('/locations/{location}', [App\Http\Controllers\LocationController::class, 'update']);
    
    Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);
    Route::post('/items', [App\Http\Controllers\ItemController::class, 'store']);
    Route::delete('/items/{item}', [App\Http\Controllers\ItemController::class, 'destroy']);
    Route::get('/items/{item}', [App\Http\Controllers\ItemController::class, 'edit']);
    Route::put('/items/{item}', [App\Http\Controllers\ItemController::class, 'update']);

    Route::delete('/prices/{price}', [App\Http\Controllers\PriceController::class, 'destroy']);

    Route::get('/items/{item}/prices', [App\Http\Controllers\PriceController::class, 'export']);
});

// User routes
Route::group(['middleware' => ['auth']], function(){
    Route::post('/prices', [App\Http\Controllers\PriceController::class, 'store']);

    Route::get('/monitor', [App\Http\Controllers\MonitorController::class, 'index'])->name('monitor');

    
});


