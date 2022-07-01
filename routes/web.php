<?php

use App\Http\Controllers\BandController;
use App\Http\Controllers\GarminController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

//Patients
Route::get('/addU', [PatientController::class, 'index']);
Route::post('/addU', [PatientController::class, 'store']);


//Bands
Route::get('/addB', [BandController::class, 'index'])->middleware('auth');
Route::post('/addB', [BandController::class, 'store'])->middleware('auth');

//Bands Public
Route::get('/addBP', [BandController::class, 'indexP']);

//Monitor
Route::get('/addM', [MonitorController::class, 'index']);
Route::post('/addM', [MonitorController::class, 'store']);
Route::get('/getM', [MonitorController::class, 'show']);
Route::delete('/getM', [MonitorController::class, 'destroy']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Garmin 0Auth
Route::get('/garmin/redirect', [GarminController::class, 'redirect']);
Route::get('/garmin/callback', [GarminController::class, 'callback']);

//Webhook
Route::webhooks('garmin-data/ox');
