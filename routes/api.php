<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;


use App\Http\Controllers\TemperatureDataController;

Route::get('/temperature-data', [TemperatureDataController::class, 'store']);
Route::get('/view-temperature-data', [TemperatureDataController::class, 'viewtemp']);


Route::middleware('auth.apikey')->post('/create-table', [APIController::class, 'handle']);




