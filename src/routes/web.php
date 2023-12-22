<?php

use Illuminate\Support\Facades\Route;
$namespace = 'Fahim\InfoPackage\Http\Controllers';

Route::group([
    'namespace'=>$namespace,
    'middleware'=>'web',
],function(){
    // Route::get('/', function () {
    //     return 'hello';
    // });

    Route::get('/info-add', 'InfoController@index')->name('info.add');
    Route::post('/info-store', 'InfoController@store')->name('info.store');
    Route::get('/get-user-info/{id}', 'InfoController@getUserInfo');
    Route::post('/update-user-info', 'InfoController@updateUserInfo');
    Route::get('/delete-user-info/{id}', 'InfoController@deleteUserInfo');
}
);

