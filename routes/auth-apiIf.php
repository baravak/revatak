<?php
Route::post('auth', 'UserController@auth')->name('api.auth');
Route::post('auth/theory/{enterTheory}', 'UserController@theory')->name('api.authTheory');
Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/{user}', 'UserController@show')->name('users.show');

Route::group(['prefix' => '$'], function () {
    Route::get('/', 'AssessmentController@index')->name('assessments.index');
    Route::get('{assessment}', 'AssessmentController@show')->name('assessments.show');
});

Route::get('terms', 'TermController@index')->name('api.terms.index');
Route::get('terms/{term}', 'TermController@show')->name('api.terms.show');
