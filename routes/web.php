<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;

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



Route::get('/',[UserController::class,'displayMovies'])->name('dash');

Route::get('search',[UserController::class,'search'])->name('movies.search');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['auth','middleware' => 'prevent-back-history'],function(){
Route::prefix('admin')->middleware(['roleManager:admin'])->group(function(): void{
    Route::resource('/movies', AdminController::class);
    Route::post('/upload/{id}',[AdminController::class,'update']);
    // search
    Route::get('/admin/movies/suggest',[AdminController::class, 'suggest'])->name('movies.suggest');
    //getSearchedPage
    Route::get('/movies/{id}/page',[AdminController::class, 'getMoviePage'])->name('movie.page');
});


Route::middleware(['roleManager:user'])->group(function (): void{
    Route::get('booking/dashboard/{id}', [UserController::class, 'index'])->name('user.booking.panel');
    Route::get('welcome/dashboard',[UserController::class,'displayMovies'])->name('user.dashboard');
    Route::post('booking/store',[UserController::class,'store'])->name('booking.store');

    // for history
    Route::get('/history',[UserController::class,'history'])->name('my.bookings');
});
});
