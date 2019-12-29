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

// API
Route::group(['prefix' => 'api/api'], function () {

    Route::get('/', function () {
        return response()->json('API_PLATFOM');
    });


    Route::post('dologin', 'apiapi@dologin');

});

Route::get('login', 'login@index')->name('login');
Route::get('dologout', 'login@dologout');

Route::get('dashboard', 'dashboard@index')->name('dashboard');

Route::get('/', function () {
    return redirect()->route('login');
});
