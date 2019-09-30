<?php

/**
 * BACKEND AUTH ROUTES
 */

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login' , [
        'as' 	 => 'auth.login',
        'authorized' => true,
        'uses'   => 'LoginController@login',
    ]);


    Route::post('/login' , [
        'as' 	 => 'auth.login.post',
        'authorized' => true,
        'uses'   => 'LoginController@authenticate',
    ]);

});












