<?php

use \Illuminate\Support\Facades\Route;

Route::prefix('api')
    ->namespace('AbediMostafa\ToDo\http\Controllers')
    ->middleware(['auth:api', 'auth.bearer'])
    ->group(function () {

        //~~ route for adding a label
        Route::post('/labels', 'LabelController@store')->name('labels.store');

        //~~ route for getting list of labels
        Route::get('/labels', 'LabelController@apiIndex')->name('labels.apiIndex');

        //~~ route for adding a task
        Route::post('/tasks', 'TaskController@store')->name('tasks.store');

        //~~ route for getting list of tasks
        Route::get('/tasks', 'TaskController@apiIndex')->name('tasks.apiIndex');

        //~~ route for changing status of a task
        Route::post('/tasks/change-status', 'TaskController@changeStatus')->name('tasks.changeStatus');

        //~~ route for editing a task
        Route::put('/tasks/{task}', 'TaskController@update')->name('tasks.update');

        //~~ route for getting task details
        Route::get('/tasks/{task}', 'TaskController@show')->name('tasks.show');
    });
