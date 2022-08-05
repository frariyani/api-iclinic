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
Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('logout', 'Api\AuthController@logout');

    // CRUD ROLE
    Route::post('role/create', 'Api\RoleController@store');
    Route::get('role/show', 'Api\RoleController@show');
    Route::post('role/update', 'Api\RoleController@update');
    Route::delete('role/delete/{id}', 'Api\RoleController@delete');
    
    // CRUD USER
    Route::post('user/create', 'Api\UserController@store');
    Route::get('user/show', 'Api\UserController@show');
    Route::get('user/profile/{id}', 'Api\UserController@showUserByID');
    Route::post('user/update', 'Api\UserController@update');
    Route::delete('user/delete/{id}', 'Api\UserController@delete');

    // CRUD PATIENT
    Route::post('patient/create', 'Api\PatientController@store');
    Route::get('patient/show', 'Api\PatientController@show');
    Route::get('patient/get/{id}', 'Api\PatientController@showPatientByID');
    Route::post('patient/update', 'Api\PatientController@update');
    Route::delete('patient/delete/{id}', 'Api\PatientController@delete');

    // CRUD ILLNESS
    Route::post('illness/create', 'Api\IllnessController@store');
    Route::get('illness/show', 'Api\IllnessController@show');
    Route::get('illness/get/{id}', 'Api\IllnessController@showIllnessByID');
    Route::post('illness/update', 'Api\IllnessController@update');
    Route::delete('illness/delete/{id}', 'Api\IllnessController@delete');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
