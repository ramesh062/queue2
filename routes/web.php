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
    return view('home');
});

Route::get('simple-queue','QueueController@simpleQueue')->name('simple-queue');
Route::get('delayed-dispatching','QueueController@delayedDispatchingQueue')->name('delayed-dispatching');
Route::get('synchronous-dispatching','QueueController@synchronousDispatchingQueue')->name('synchronous-dispatching');

Route::post('change-status','QueueController@changeStatus')->name('change-status');

