<?php

use AbediMostafa\ToDo\http\Models\Label;
use AbediMostafa\ToDo\http\Models\Task;
use \Illuminate\Support\Facades\Route;

Route::namespace('AbediMostafa\ToDo\http\Controllers')
    ->middleware('web')
    ->group(function () {

        Route::post('/register', 'AuthController@handleRegister');
        Route::post('/login', 'AuthController@handleLogin');

        Route::get('/login', 'AuthController@login')->name('login');
        Route::get('/logout', 'AuthController@logout')->name('logout');
        Route::get('/register', 'AuthController@register')->name('register');

        Route::resources([
            'tasks' => 'TaskController',
            'labels' => 'LabelController',
        ]);

        Route::get('/get-labels', 'LabelController@get')->name('labels.get');
    });
