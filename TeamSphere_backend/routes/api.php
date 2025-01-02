<?php

use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PresenceController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('presences', PresenceController::class);
    Route::controller(PresenceController::class)->group(function () {
        Route::get('presences/search/{search}', 'search_presences');
    });

    // Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('permissions', PermissionController::class)->except(['update']);
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->middleware('admin');

    Route::controller(PermissionController::class)->group(function () {
        Route::get('permission/search/{search}', 'search_permissions');
    });


    Route::apiResource('users', UserController::class)->except(['update'])->middleware('admin');
    Route::put('users/{users}', [UserController::class,'update']);
    Route::controller(UserController::class)->group(function () {
        Route::get('users/search/{search}', 'search_users');
    })->middleware('admin');


});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require __DIR__.'/auth.php';
