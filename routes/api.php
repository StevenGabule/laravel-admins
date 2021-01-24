<?php


Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResource('users', 'UserController');
    Route::apiResource('roles', 'RolesController');
    Route::apiResource('products', 'ProductController');
    Route::apiResource('orders', 'OrderController')->only('index', 'show');
    Route::get('exports', 'OrderController@export');
    Route::apiResource('permissions', 'PermissionController')->only('index');
    Route::get('chart', 'DashboardController@chart');

    Route::get('users/profile', 'UserController@profile');
    Route::put('users/update_profile', 'UserController@updateProfile');
    Route::put('users/update_password', 'UserController@updatePassword');
    Route::post('upload', 'ImageController@upload');

    Route::post('logout', 'Auth\Authcontroller@logout')->name('logout');

});
Route::post('login', 'Auth\Authcontroller@login')->name('login');
Route::post('register', 'Auth\Authcontroller@register')->name('register');
