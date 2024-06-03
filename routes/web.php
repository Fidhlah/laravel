<?php

use App\Http\Controllers\Frontend\CarController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DriverController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
Route::get('/',[HomepageController:: class, 'index' ])->name('homepage');
Route::get('/services',[ServiceController:: class, 'index' ])->name('services');
Route::get('/cars',[CarController:: class, 'index' ])->name('cars');
Route::get('/contact',[ContactController:: class, 'index' ])->name('contact');
Route::get('/order',[DriverController:: class, 'index' ])->name('drivers');


Route::get('/riwayat', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('riwayat');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth','UserMiddleware'])->group(function () {

});




require __DIR__.'/auth.php';
