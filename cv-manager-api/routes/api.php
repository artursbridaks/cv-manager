<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserDataController;
use App\Http\Controllers\Api\EmploymentController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\AddressController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User Data
Route::get('users-data', [UserDataController::class, 'getUsersData']);
Route::post('users-data', [UserDataController::class, 'createUsersData']);
Route::get('users-data/{id}', [UserDataController::class, 'getSingleUserData']);
Route::get('users-data/{id}/edit', [UserDataController::class, 'editSingleUserData']);
Route::put('users-data/{id}/edit', [UserDataController::class, 'updateSingleUserData']);
Route::delete('users-data/{id}/delete', [UserDataController::class, 'deleteSingleUserData']);

// Employment Data
Route::get('employment', [EmploymentController::class, 'getEmploymentData']);
Route::post('employment/{user_data_id}', [EmploymentController::class, 'createEmploymentData']);
Route::get('employment/{id}', [EmploymentController::class, 'getSingleEmploymentData']);
Route::get('employment/user/{user_data_id}', [EmploymentController::class, 'getAllEmploymentDataByUser']);
Route::put('employment/update', [EmploymentController::class, 'updateEmploymentData']);
Route::delete('employment/{id}/delete', [EmploymentController::class, 'deleteSingleEmploymentData']);

// Education Data
Route::get('education', [EducationController::class, 'getEducationData']);
Route::post('education/{user_data_id}', [EducationController::class, 'createEducationData']);
Route::get('education/{id}', [EducationController::class, 'getSingleEducationData']);
Route::get('education/user/{user_data_id}', [EducationController::class, 'getAllEducationDataByUser']);
Route::put('education/update', [EducationController::class, 'updateEducationData']);
Route::delete('education/{id}/delete', [EducationController::class, 'deleteSingleEducationData']);

// Address Data
Route::get('address', [AddressController::class, 'getAllAddressData']);
Route::post('address/{user_data_id}', [AddressController::class, 'createAddressData']);
Route::get('address/{id}', [AddressController::class, 'getSingleAddressData']);
Route::get('address/user/{user_data_id}', [AddressController::class, 'getAddressData']);
Route::put('address/{id}/edit', [AddressController::class, 'updateSingleAddressData']);
Route::delete('address/{id}/delete', [AddressController::class, 'deleteSingleAddressData']);