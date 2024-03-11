<?php


use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TemperatureDataController;

Route::get('/temperature-data', [TemperatureDataController::class, 'store']);
