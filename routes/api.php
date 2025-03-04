<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

#### Api Start Here ####
Route::post('/device_details', [ApiController::class, 'device_details']);  // device_details api 
Route::post('/user_signup', [ApiController::class, 'user_signup']);  // registered api 
Route::post('/verify_otp', [ApiController::class, 'verify_otp']);    //  otp verification 
Route::post('/user_login', [ApiController::class, 'user_login']);    //  login api 
Route::get('/show_slider', [ApiController::class, 'show_slider']);  // Slider Show
Route::post('/update_profile', [ApiController::class, 'update_profile']);  // Update profile
Route::post('/update_profile_image', [ApiController::class, 'update_profile_image']);  // Update Profile Image
Route::post('/user_details', [ApiController::class, 'user_details']);         // User Details 


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
