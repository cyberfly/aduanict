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

//unit manager assign route

Route::get('complain/assign','ComplainController@assign')->name('complain.assign');
Route::get('complain/{complain}/assign','ComplainController@assign_staff')->name('complain.assign_staff');
Route::put('complain/assign/{complain}','ComplainController@update_assign_staff')->name('complain.update_assign_staff');

//helpdesk action route

Route::get('complain/{complain}/action','ComplainController@action')->name('complain.action');
Route::put('complain/action/{complain}','ComplainController@update_action')->name('complain.update_action');

//tehnical action route

Route::get('complain/{complain}/technical_action','ComplainController@technical_action')->name('complain.technical_action');
Route::put('complain/technical_action/{complain}','ComplainController@update_technical_action')->name('complain.update_technical_action');


//verify aduan route

Route::put('complain/verify/{complain}','ComplainController@verify')->name('complain.verify');

//ajax action route

Route::get('complain/assets','ComplainController@get_assets')->name('complain.assets');
Route::get('complain/locations','ComplainController@get_locations')->name('complain.locations');

//resource controller route

Route::resource('complain', 'ComplainController');

Route::auth();

Route::get('/home', 'HomeController@index');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */

Route::group(['prefix' => 'admin'], function () {

    Route::resource('users', 'Admin\AdminUsersController');
    Route::resource('roles', 'Admin\AdminRolesController');
    Route::resource('permissions', 'Admin\AdminPermissionsController');

});
