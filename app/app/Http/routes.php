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
