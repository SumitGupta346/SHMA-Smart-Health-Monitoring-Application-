<?php

use Illuminate\Support\Facades\Route;

// Home Page Routes

Route::get('/', 'FrontEndController@index');
Route::get('/treems', 'FrontEndController@treems');
Route::post('/get_symptoms1', 'FrontEndController@get_symptoms1')->name('get_symptoms1');
Route::post('/get_symptoms2', 'FrontEndController@get_symptoms2')->name('get_symptoms2');
Route::post('/get_symptoms3', 'FrontEndController@get_symptoms3')->name('get_symptoms3');
Route::post('/analyze', 'FrontEndController@analyze')->name('analyze');
Route::get('/doctors', 'Api\\v1\\HealthMonitorController@get_doctors');
Route::get('/new-appointment/{doctorId}/{date}', 'FrontEndController@show')->name('create.appointment');

Route::get('/dashboard', 'DashBoardController@index');

Route::get('admin/doctor_feedbacks', 'FeedbackController@doctor_feedbacks')->name('doctor_feedbacks');
Route::get('admin/patient_feedbacks', 'FeedbackController@patient_feedbacks')->name('patient_feedbacks');
Route::get('/home', 'HomeController@index');
Route::get('doctor/feedback', 'DoctorController@feedback')->name('doctor.feedback');
Route::post('doctor/feedback_store', 'DoctorController@feedback_store')->name('doctor.feedback_store');
Route::get('/doctor/patients', 'DoctorController@dpatients')->name('doctor.dpatients');
Route::get('/doctor/disease_info', 'DoctorController@disease_info')->name('doctor.disease_info');
Route::get('/doctor/patient_data/{id}', 'DoctorController@view_patient_data')->name('doctor.view_patient_data');
Route::get('/doctor/my_profile', 'DoctorController@my_profile')->name('doctor.my_profile');
Auth::routes();
Route::get('/get_vitals1', 'Api\\v1\\HealthMonitorController@vital_details1');
// Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('doctor', 'DoctorController');


    Route::resource('/department', 'DepartmentController');
    Route::get('/patients', 'DoctorController@patients')->name('doctor.patients');
});

