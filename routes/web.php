<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RfidController;

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
    Route::prefix('/home')->group(function(){
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::post('/changeDate', [HomeController::class,'updateDate']);
    });
    
    Route::get('/changePassword',[HomeController::class, 'showChangePasswordGet']);
    Route::post('/changePassword',[HomeController::class, 'changePasswordPost']);

    Route::group(['middleware' => 'is_admin'], function(){
        Route::prefix('employees')->group(function(){
            Route::post('/', [TeachersController::class,'store']);
            Route::get('/', [TeachersController::class,'index']);
            Route::get('/{status}/{id}', [TeachersController::class,'status']);
            Route::get('/{id}', [TeachersController::class,'edit']);
            Route::post('/update/{id}', [TeachersController::class,'update']);
        });
    
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class,'index']);
            Route::post('add_data', [UserController::class,'store'])->name('add_data');
            Route::get('/{id}', [UserController::class,'edit'])->name('edit_data');
            Route::post('/update/{id}', [UserController::class,'update'])->name('update_data');
        });
        
        Route::get('/reports', [ReportsController::class,'index']);
    });
    
    

    Route::prefix('rfid')->group(function(){
        Route::get('/',[RfidController::class,'index']);
        Route::post('/',[RfidController::class,'store']);
    });


});






