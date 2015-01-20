<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function () {
    return View::make('hello');
});

Route::get('/form', 'FormController@create');

Route::post('/todo', 'ToDoController@getJSON');

Route::get('/test', function(){
    $smth = Holiday::where('day','=','24')->where('month','=','09')->get();
    return (sizeof($smth));
});


