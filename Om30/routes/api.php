<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PatientsController};
Route::get('/', function () {
    return view('home', ['name' => 'Danyllo']);
});
Route::resource('patients',PatientsController::class);

Route::group(['middleware' => 'auth:api'], function () {});

Route::any('*', function () {  return view('home', ['name' => 'Danyllo']); });
