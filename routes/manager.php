<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FinancialmanagementController;
use App\Http\Controllers\Loyalty_ProgramController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhishlistController;
use Illuminate\Support\Facades\Route;

// _________________________________________________________

Route::group([
    'prefix' => 'manager',
    'middleware' => ['auth:sanctum', 'role:manager'],
    'as' => 'manager.'
], function () {

    Route::apiResource('/employee', EmployeeController::class);
    Route::apiResource('/financial', FinancialmanagementController::class);
    Route::apiResource('/Loyalty_Program', Loyalty_ProgramController::class);
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/reservation', ReservationController::class);
    Route::apiResource('/room', RoomController::class);
    Route::get('/allreser', [ReservationController::class, 'allreser']);
    Route::apiResource('/review', ReviewController::class);
    Route::get('/searchroom', [RoomController::class, 'searchroom']);
    Route::get('/searchservices', [ServiceController::class, 'searchservices']);
    Route::get('/searchemployee', [EmployeeController::class, 'searchemployee']);
    Route::apiResource('/service', ServiceController::class);
    Route::apiResource('/user', UserController::class);
    Route::apiResource('/whishlist', WhishlistController::class);
});
