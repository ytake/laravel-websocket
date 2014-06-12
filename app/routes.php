<?php

\Route::group(['namespace' => 'App\Controllers'], function (){

    \Route::get('/', 'HomeController@getIndex');
    \Route::resource('emit', 'EmitController', ['only' => ['index', 'store']]);
    \Route::resource('socket', 'SocketIoController', ['only' => ['index', 'store']]);
});
