<?php

use \Illuminate\Support\Facades\Route;

Route::prefix('api')->namespace()->group(function () {
    Route::get('/login','LoginController@login');
});

