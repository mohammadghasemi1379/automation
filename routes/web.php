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

Route::get('/', function () { return view('welcome');});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('ticket', 'TicketController');
Route::get('ticket/answer/{subject_id}' , 'TicketController@answer');
Route::post('ticket/answers' , 'TicketController@answers')->name('answers');
Route::resource('TicketBody' , 'TicketBodyController');

Route::resource('task', 'TaskController');

Route::get('enter' , 'TaskController@enter')->name('enter');
Route::get('exit' , 'TaskController@exit')->name('exit');
Route::get('staff/{id}' , 'TaskController@staff');

Route::resource('todo', 'TodoController');
Route::post('done' , 'TodoController@done')->name('done');

Route::resource('AddSubject', 'SubjectController');


