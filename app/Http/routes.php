<?php

Route::group(['prefix' => 'api/v1'], function() {
    Route::post('authenticate', 'AuthController@authenticate');

    Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function() {
        Route::resource('documents', 'DocumentsController');
    });
});

