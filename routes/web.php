<?php

use App\Http\Controllers\AirbaseController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PlaneairbaseController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\SpaceController;
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
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('',[App\Http\Controllers\MapController::class,'index'])->name('def');
Route::get('/home',[App\Http\Controllers\MapController::class,'index'])->name('home');
Route::get('/map',[App\Http\Controllers\MapController::class,'index'])->name('map.index');
Route::get('/map/{slug}',[App\Http\Controllers\MapController::class,'show'])->name('map.show');

Route::get('/gis', function () {
    return view('index');
});

Route::get('/lay', function () {
    return view('layout.content');
});

Route::get('/lax', function () {
    return view('layout.app');
});

Route::resource('centre-point',(CentreController::class));
Route::get('/centrepoint/data',[DataController::class,'centrepoint'])->name('centre-point.data');

Route::resource('space',(SpaceController::class));
Route::get('/spaces/data',[DataController::class,'spaces'])->name('data-space');

Route::resource('country',(CountryController::class));
Route::get('/countries/data',[CountryController::class,'countries'])->name('data-country');

Route::resource('airbase',(AirbaseController::class));
Route::get('/airbases/data',[AirbaseController::class,'airbases'])->name('data-airbase');

Route::resource('plane',(PlaneController::class));
Route::get('/planes/data',[PlaneController::class,'planes'])->name('data-plane');

Route::resource('planeairbase',(PlaneairbaseController::class));
Route::get('/planeairbases/data',[PlaneairbaseController::class,'planeairbases'])->name('data-planeairbase');

