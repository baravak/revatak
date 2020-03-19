<?php
Route::group([
    'namespace' => '\App\Http\Controllers\API',
], function () {
    Route::post('register', 'UserController@register')->name('api.register');
    Route::post('auth/verification', 'UserController@verification')->name('api.auth.verification');
    Route::post('auth/recovery', 'UserController@recovery')->name('api.auth.recovery');

});
Route::group([
    'namespace' => '\App\Http\Controllers\API',
    'as' => 'api.'
], function () {
    Route::group([
        'middleware' => [Route::authIf()],
    ], function () {
        require_once('auth-apiIf.php');
    });
    Route::group([
        'middleware' => ['auth:api'],
    ], function () {
        require_once('auth-api.php');
    });
    Route::get('users-documantion', 'UserController@doc')->name('users.doc');
});
Route::get('test', function(){
    return ['test' => 10];
});
