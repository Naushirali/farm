<?php


use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TemperatureDataController;

Route::get('/temperature-data', [TemperatureDataController::class, 'store']);
Route::get('/view-temperature-data', [TemperatureDataController::class, 'viewtemp']);
