<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/contact-types', 'ContactTypeController@index');
Route::post('/contact-type', 'ContactTypeController@store');
Route::delete('/contact-type/{contactType}', 'ContactTypeController@destory');

Route::get('/medicines', 'MedicineController@index');
Route::post('/medicine', 'MedicineController@store');
Route::delete('/medicine/{medicine}', 'MedicineController@destory');

Route::get('/positions', 'PositionController@index');
Route::post('/position', 'PositionController@store');
Route::delete('/position/{position}', 'PositionController@destory');

Route::get('/patients', 'PatientController@index');
Route::post('/patient', 'PatientController@store');
Route::delete('/patient/{patient}', 'PatientController@destory');

Route::get('/patient/{patient}/contacts', 'ContactController@index');
Route::post('patient/{patient}/contact', 'ContactController@store');
Route::delete('/contact/{contact}', 'ContactController@destory');

Route::get('/staff', 'StaffController@index');
Route::post('/staff', 'StaffController@store');
Route::delete('/staff/{staff}', 'StaffController@destory');

Route::get('/staff/{staff}/contacts', 'ContactController@index');
Route::post('/staff/{staff}/contact', 'ContactController@store');
