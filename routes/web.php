<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;

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

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::prefix('employees')->group(function(){
    Route::post('/', [TeachersController::class,'store'])->middleware('auth');
    Route::get('/', [TeachersController::class,'index'])->middleware('auth');
    Route::get('/{status}/{id}', [TeachersController::class,'status'])->middleware('auth');
    Route::get('/{id}', [TeachersController::class,'edit'])->middleware('auth');
});


Route::get('/users', [UserController::class,'index'])->middleware('auth');
Route::get('/reports', [ReportsController::class,'index'])->middleware('auth');

