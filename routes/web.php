<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/accounts', 'PersonnelProfileController@index');
Route::resource('accounts', 'PersonnelProfileController');
Route::resource('patients', 'PatientsController');
Route::resource('hospitals', 'HospitalsController');
Route::resource('forums', 'PostsController');
Route::resource('records', 'RecordsController');
Route::resource('appointments', 'AppointmentsController');
Route::post('/comments', 'CommentsController@store');
Route::post('/fileUpload', 'FileController@store');
Route::get('/files/{id}', 'FileController@index');
Route::get('/files/{id}/toggle', 'FileController@update');
Route::get('/mypatients', 'PatientsController@myPatients');
Route::get('/add', 'RelationshipsController@store');

Route::get('/layout', function(){
    return view('layouts.app');
});

Route::get('/simplified', function(){
    return view('layouts.simplified');
});

Route::get('/mail', function(){
    return new App\Mail\AccountConfirm();
});