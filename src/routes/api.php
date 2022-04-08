<?php

use \Illuminate\Support\Facades\Route;

Route::get('test', function(){
   return 'salam';
});

Route::prefix('api')->namespace('AbediMostafa\ToDo\http\Controllers')->group(function () {
    Route::get('/login','LoginController@login');
});

