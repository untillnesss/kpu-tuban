<?php

// API
Route::group(['prefix' => 'api/api'], function () {

    Route::get('/', function () {
        return response()->json('API_PLATFOM');
    });

    Route::post('dologin', 'apiapi@dologin');

    Route::get('getoperator', 'apiapi@getoperator');
    Route::post('addoperator', 'apiapi@addoperator');
    Route::post('getoperator/{id}', 'apiapi@getoperatordetail');
    Route::post('deleteoperator', 'apiapi@deleteoperator');
    Route::post('updateoperator', 'apiapi@updateoperator');
});

Route::get('login', 'login@index')->name('login');
Route::get('dologout', 'login@dologout');

// DASHBOARD
Route::get('dashboard', 'dashboard@index')->name('dashboard');

// OPERATOR
Route::get('operator', 'operator@index')->name('operator');
Route::get('calon', 'calon@index')->name('calon');

Route::get('/', function () {
    return redirect()->route('login');
});
