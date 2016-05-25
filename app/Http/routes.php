<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
return view('auth.login');
});

/*ROUTE FOR MODULE ADUAN*/

/*

Route::get('aduan/index', function () {
    return view('complains/index');
});

Route::get('aduan/create', function () {
    return view('complains/create');
});

Route::get('aduan/edit', function () {
    return view('complains/edit');
});

Route::get('aduan/show', function () {
    return view('complains/show');
});

*/

Route::resource('complain', 'ComplainController');

Route::auth();

Route::get('/home', 'HomeController@index');
