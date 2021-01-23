<?php


Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResource('users', 'UserController');
});
Route::post('login', 'Auth\Authcontroller@login')->name('login');
