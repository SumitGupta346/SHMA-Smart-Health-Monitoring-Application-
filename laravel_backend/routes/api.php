<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Api\\v1\\Auth\\CustomerAuthController@login');
Route::post('/register', 'Api\\v1\\Auth\\CustomerAuthController@registration');

Route::group(['prefix' => 'patient', 'middleware' => 'auth:api'], function () {
    Route::post('/predict_disease', 'Api\\v1\\HealthMonitorController@predict_disease');
    Route::post('/save_feedback', 'Api\\v1\\HealthMonitorController@save_feedback');
    Route::post('/save_food_intake', 'Api\\v1\\HealthMonitorController@save_food_intake');
    Route::post('/save_water_intake', 'Api\\v1\\HealthMonitorController@save_water_intake');
    Route::post('/save_sleep_hours', 'Api\\v1\\HealthMonitorController@save_sleep_hours');
    Route::post('/save_bmi', 'Api\\v1\\HealthMonitorController@save_bmi');
    Route::post('/get_vitals', 'Api\\v1\\HealthMonitorController@vital_details');
    Route::post('/get_departments', 'Api\\v1\\HealthMonitorController@get_departments');
    Route::post('/get_doctors', 'Api\\v1\\HealthMonitorController@get_doctors');
    Route::post('/get_foods', 'Api\\v1\\HealthMonitorController@get_foods');
});
