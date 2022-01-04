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

Route::prefix('seven')->group(function() {
    Route::get('/', 'SevenController@index');

    Route::prefix('settings')->group(function() {
        Route::get('/', 'SettingsController@index');
        Route::post('/', 'SettingsController@update');
    });

    //Route::get('/settings', 'SettingsController@index');
    //Route::post('/settings', 'SettingsController@update');
});
