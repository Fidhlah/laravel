<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[App\Http\Controllers\Frontend\HomepageController:: class, 'index' ])->name('homepage');
Route::get('/services',[App\Http\Controllers\Frontend\ServiceController:: class, 'index' ])->name('services');
Route::get('/cars',[App\Http\Controllers\Frontend\CarController:: class, 'index' ])->name('cars');
Route::get('/contact',[App\Http\Controllers\Frontend\ContactController:: class, 'index' ])->name('contact');
Route::get('/order',[App\Http\Controllers\Frontend\DriverController:: class, 'index' ])->name('drivers');
// Route::get('/search-cars', [App\Http\Controllers\Frontend\CarController::class, 'search'])->name('search.cars');
// Route::get('/', function () {
//     return view('frontend.homepage');
// });
