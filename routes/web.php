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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/movies', 'MovieController');
Route::resource('/people', 'PeopleController');

Route::get('/uploadGendersFromCineAr', 'UploadFromSourceController@genders');
Route::get('/uploadPeopleFromCineAr', 'UploadFromSourceController@people');
Route::get('/uploadMoviesFromCineAr', 'UploadFromSourceController@movies');


Route::get('/uploadMoviesFromGoogle', 'UploadFromSourceController@google');
Route::get('/pelispedia', 'UploadFromSourceController@pelispedia');
Route::get('/sourcesInitialization', 'UploadFromSourceController@sourcesInitialization');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
