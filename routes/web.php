<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoutenanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('soutenances', SoutenanceController::class);

use App\Http\Controllers\JuryController;

Route::resource('juries', JuryController::class);