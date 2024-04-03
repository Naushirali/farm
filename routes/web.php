<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Loginmanager;
use App\Http\Controllers\Authmanager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('loginregister.login');})->middleware('user');


Route::get('/login', [Loginmanager::class,'login'])->name('login')->middleware(['user']);
Route::post('/login', [Loginmanager::class,'loginpost'])->name('login.post')->middleware(['user']);
// Route::get('/registration', [Loginmanager::class,'registration'])->name('registration')->middleware(['user']);
// Route::post('/registration', [Loginmanager::class,'registrationpost'])->name('registration.post')->middleware(['user']);

Route::get('/logout', [Loginmanager::class,'logout'])->name('logout');



Route::get('/welcome', [Authmanager::class,'welcome'])->name('welcome')->middleware(['guests']);





Route::get('/customer', [Authmanager::class,'customer'])->name('customer')->middleware(['guests']);
Route::get('/createcustomer', [Authmanager::class,'createcustomer'])->name('createcustomer')->middleware(['guests']);
Route::post('/createcustomer', [Authmanager::class,'createcustomerpost'])->name('createcustomer.post')->middleware(['guests']);
Route::get('/viewcustomer/{id}', [Authmanager::class,'viewcustomer'])->name('viewcustomer')->middleware(['guests']);
Route::get('/editcustomer/{id}', [Authmanager::class,'editcustomer'])->name('editcustomer')->middleware(['guests']);
Route::put('updatecustomer/{id}', [Authmanager::class,'updatecustomer'])->name('updatecustomer')->middleware(['guests']);
Route::get('deletecustomer/{id}', [Authmanager::class,'deletecustomer'])->name('deletecustomer')->middleware(['guests']);





Route::get('/branch', [Authmanager::class,'branch'])->name('branch')->middleware(['guests']);
Route::get('/createbranch', [Authmanager::class,'createbranch'])->name('createbranch')->middleware(['guests']);
Route::post('/createbranch', [Authmanager::class,'createbranchpost'])->name('createbranch.post')->middleware(['guests']);
Route::get('/viewbranch/{id}', [Authmanager::class,'viewbranch'])->name('viewbranch')->middleware(['guests']);
Route::get('/editbranch/{id}', [Authmanager::class,'editbranch'])->name('editbranch')->middleware(['guests']);
Route::put('updatebranch/{id}', [Authmanager::class,'updatebranch'])->name('updatebranch')->middleware(['guests']);
Route::get('deletebranch/{id}', [Authmanager::class,'deletebranch'])->name('deletebranch')->middleware(['guests']);






Route::get('/branchowners', [Authmanager::class,'branchowners'])->name('branchowners')->middleware(['guests']);
Route::get('/createbranchowners', [Authmanager::class,'createbranchowners'])->name('createbranchowners')->middleware(['guests']);
Route::post('/createbranchowners', [Authmanager::class,'createbranchownerspost'])->name('createbranchowners.post')->middleware(['guests']);
Route::get('/viewbranchowners/{id}', [Authmanager::class,'viewbranchowners'])->name('viewbranchowners')->middleware(['guests']);
Route::get('/editbranchowners/{id}', [Authmanager::class,'editbranchowners'])->name('editbranchowners')->middleware(['guests']);
Route::put('updatebranchowners/{id}', [Authmanager::class,'updatebranchowners'])->name('updatebranchowners')->middleware(['guests']);





