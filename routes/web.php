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



Route::group(['middleware' => 'auth'], function() {
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/changePassword',[HomeController::class, 'showChangePasswordGet']);
    Route::post('/changePassword',[HomeController::class, 'changePasswordPost']);

    Route::prefix('employees')->group(function(){
        Route::post('/', [TeachersController::class,'store']);
        Route::get('/', [TeachersController::class,'index']);
        Route::get('/{status}/{id}', [TeachersController::class,'status']);
        Route::get('/{id}', [TeachersController::class,'edit']);
        Route::post('/update/{id}', [TeachersController::class,'update']);
    });

    Route::get('/users', [UserController::class,'index']);
    Route::get('/reports', [ReportsController::class,'index']);

});






