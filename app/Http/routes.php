<?php

Route::group(['prefix' => 'api/v1'], function() {
    Route::post('authenticate', 'AuthController@authenticate');
    Route::get('refresh', 'AuthController@refresh');

    Route::resource('documents', 'DocumentsController');
    Route::group(['middleware' => ['jwt.auth']], function() {
    });
});

