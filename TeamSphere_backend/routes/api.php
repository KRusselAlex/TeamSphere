<?php

use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PresenceController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::apiResource('presences', PresenceController::class);
    Route::controller(PresenceController::class)->group(function () {
        Route::get('presences/search/{search}', 'search_presences');
    });

    Route::apiResource('notifications', PresenceController::class);
    Route::apiResource('permissions', PermissionController::class);
    Route::controller(PermissionController::class)->group(function () {
        Route::get('permission/search/{search}', 'search_permissions');
    });


    Route::apiResource('users', UserController::class);
    Route::controller(UserController::class)->group(function () {
        Route::get('users/search/{search}', 'search_users');
    });


});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
