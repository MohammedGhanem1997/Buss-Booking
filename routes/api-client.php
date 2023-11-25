<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'App\Http\Controllers\Api\V1\Client'], function () {
    Route::get('/',function (){

        return ok_response( auth()->guard('api' )->user());
    });

    Route::post('signin',[\App\Http\Controllers\Api\V1\Auth\AuthController::class,'login']);
    Route::post('register',[\App\Http\Controllers\Api\V1\Auth\AuthController::class,'register']);
    Route::get('trips',[\App\Http\Controllers\Api\V1\Client\TripsController::class,'index']);


});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'App\Http\Controllers\Api\V1\Client',  'middleware' => ['auth:api']], function () {


    Route::apiResource('bookings', \App\Http\Controllers\Api\V1\Client\BookingApiController::class);


});
