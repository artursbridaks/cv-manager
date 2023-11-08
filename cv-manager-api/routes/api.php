<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserDataController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users-data', [UserDataController::class, 'getUsersData']);
Route::post('users-data', [UserDataController::class, 'createUsersData']);
Route::get('users-data/{id}', [UserDataController::class, 'getSingleUserData']);
Route::get('users-data/{id}/edit', [UserDataController::class, 'editSingleUserData']);
Route::put('users-data/{id}/edit', [UserDataController::class, 'updateSingleUserData']);
Route::delete('users-data/{id}/delete', [UserDataController::class, 'deleteSingleUserData']);
