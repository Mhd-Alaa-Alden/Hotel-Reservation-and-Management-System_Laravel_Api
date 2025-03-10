<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'service',
    'middleware' => ['auth:sanctum', 'role:service'],
    'as' => 'service.'
], function () {
    Route::get('/searchservices', [ServiceController::class, 'searchservices']);
    Route::get('/service', [ServiceController::class, 'index']);
    Route::apiResource('/service', ServiceController::class);
    Route::apiResource('/room', RoomController::class)->names([

        'index' => 'service.room.index',
        'show' => 'service.room.show',
    ]);
});
