<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhishlistController;
use Illuminate\Support\Facades\Route;


Route::get('/room', [RoomController::class, 'index']);
Route::get('/service', [ServiceController::class, 'index']);


Route::group([
    'prefix' => 'client',
    'middleware' => ['auth:sanctum', 'role:client'],
    'as' => 'client.'

], function () {
    Route::apiResource('/review', ReviewController::class)
        ->names([
            'index'   => 'client.review.index',
            'store'   => 'client.review.store',
            'destroy'   => 'client.review.destroy',
        ]);

    Route::apiResource('/reservation', ReservationController::class);
    Route::get('/searchroom', [RoomController::class, 'searchroom']);
    Route::apiResource('/room', RoomController::class)
        ->names([

            'show'    => 'client.room.show',
        ]);

    Route::get('/searchservices', [ServiceController::class, 'searchservices']);
    Route::apiResource('/service', ServiceController::class)
        ->names([

            'show'    => 'client.service.show',
        ]);
    Route::post('/orderService', [ServiceController::class, 'orderService']);

    Route::apiResource('/user', UserController::class)
        ->names([

            'show'    => 'client.user.show',
        ]);
    Route::apiResource('/whishlist', WhishlistController::class)
        ->names([

            'index'   => 'client.whishlist.index',
            'show'    => 'client.whishlist.show',
            'destroy' => 'client.whishlist.destroy',
        ]);
});
