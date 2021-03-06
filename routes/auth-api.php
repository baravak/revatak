<?php
Route::post('auth/as/{user}', 'UserController@authAs')->name('auth.as');

Route::post('logout', 'UserController@logout')->name('logout');
Route::post('auth/back', 'UserController@authBack')->name('auth.back');

Route::post('users', 'UserController@store')->name('users.store');
Route::put('users/{user}', 'UserController@update')->name('users.update');
Route::post('users/{user}/avatar', 'UserController@avatar')->name('users.store.avatar');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');


Route::put('me', 'UserController@meUpdate')->name('users.me.update');
Route::get('me', 'UserController@me')->name('me');


Route::put('auth/password/change', 'UserController@changePassword')->name('api.auth.changePassword');
Route::apiResource('terms', 'TermController', ['except' => ['index', 'show']]);

Route::apiResource('stories', 'StoryController', ['except' => ['index', 'show']]);
Route::apiResource('posts', 'PostController', ['except' => ['index', 'show']]);
