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

// Example 'tasks/2017-08-15'
Route::get('tasks/{date}', 'TaskController@indexByDate')
    ->where('date', '^[0-9]{4}-(0[1-9]|1[0-2])-([1-9]|0[1-9]|[1-2][0-9]|3[0-1])$');

Route::resource('tasks', 'TaskController');

