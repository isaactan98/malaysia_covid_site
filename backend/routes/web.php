<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\StateFlagController;
use App\Http\Controllers\VaccineController;
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


//API from MOH
Route::get('/api/cases', [CaseController::class, 'index'], function () {
    return response();
});

Route::get('/api/state', [CaseController::class, 'statesall'], function () {
    return response();
});

Route::get('/api/state/{date}', [CaseController::class, 'filterdate'], function () {
    return response();
});

Route::get('/api/death', [CaseController::class, 'death'],  function () {
    return response();
});

Route::get('/api/death/state/{date}', [CaseController::class, 'deathstate'],  function () {
    return response();
});

Route::get('/api/news', [CaseController::class, 'newsfeed'], function () {
    return response();
});

Route::get('/api/{state}/flag', [StateFlagController::class, 'stateflags'], function () {
    return response();
});

Route::get('/api/vaccine/all', [VaccineController::class, 'showtotal'], function () {
    return response();
});

Route::get('/api/vaccine/state/{date}', [VaccineController::class, 'showState'], function () {
    return response();
});
