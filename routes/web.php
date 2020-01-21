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

    Route::post('addcalon', 'apiapi@addcalon');
    Route::get('geturut', 'apiapi@geturut');
    Route::get('getcalon', 'apiapi@getcalon');
    Route::post('deletecalon', 'apiapi@deletecalon');
});

Route::get('login', 'login@index')->name('login');
Route::get('dologout', 'login@dologout');

// DASHBOARD
Route::get('dashboard', 'dashboard@index')->name('dashboard');

// OPERATOR
Route::get('operator', 'operator@index')->name('operator');
Route::get('calon', 'calon@index')->name('calon');

Route::group(['prefix' => 'o'], function () {
    Route::get('dashboard', 'ooperator@index')->name('ope');
});

Route::get('/', function () {
    return redirect()->route('login');
});
