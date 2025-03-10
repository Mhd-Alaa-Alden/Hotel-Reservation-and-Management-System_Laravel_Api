
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:sanctum', 'role:admin'],
    'as' => 'admin.'
], function () {

    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/service', ServiceController::class);
    Route::get('/searchservices', [ServiceController::class, 'searchservices']);



    // Route::get('/rooms', [RoomController::class, 'index']); 
    // Route::get('/room/{id}', [RoomController::class, 'show']); 

    Route::get('/searchroom', [RoomController::class, 'searchroom']);

    Route::apiResource('/room', RoomController::class)->names([
        'index' => 'room.index',
        'show' => 'room.show',
        'update' => 'room.update',
    ]);

    Route::apiResource('/reservation', ReservationController::class);
    Route::get('/allreser', [ReservationController::class, 'allreser']);

    Route::apiResource('/review', ReviewController::class);

    Route::apiResource('/user', UserController::class)->names([
        'index' => 'admin.user.index',
        'show' => 'admin.user.show',
    ]);
});
