<?php

use App\Http\Controllers\CaseController;
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

Route::get('/cases/state/all', function () {
    return view('cases/states');
});

Route::get('/cases/state/{state}', function () {
    return view();
});
