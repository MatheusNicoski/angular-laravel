<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('register', 'UserController@store')->name('user.store');
        Route::post('login', 'UserController@login')->name('user.login');
        Route::apiResource('list', 'UserController');
    });

    Route::group(['prefix' => 'user', 'middleware' => 'jwt.verify'], function () {
        Route::apiResource('profile', 'ProfileController');
        Route::put('update', 'ProfileController@update')->name('user.update');
        Route::post('logout', 'UserController@logout')->name('user.logout');
    });   

    Route::group(['prefix' => 'contact', 'middleware' => 'jwt.verify'], function () {    
        Route::apiResource('list', 'ContactController');
        Route::get('show/{id}', 'ContactController@show')->name('contact.show');
        Route::post('register', 'ContactController@store')->name('contact.store');
        Route::delete('delete/{id}', 'ContactController@destroy')->name('contact.delete');
        Route::put('update/{id}', 'ContactController@update')->name('contact.update');
    });    
});