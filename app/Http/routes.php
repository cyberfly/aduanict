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
Route::get('complain/assign','ComplainController@assign')->name('complain.assign');
Route::get('complain/{complain}/assign','ComplainController@assign_staff')->name('complain.assign_staff');
Route::put('complain/assign/{complain}','ComplainController@update_assign_staff')->name('complain.update_assign_staff');


Route::get('complain/{id}/action','ComplainController@action')->name('complain.action');
Route::put('complain/action/{complain}','ComplainController@update_action')->name('complain.update_action');

Route::put('complain/verify/{complain}','ComplainController@verify')->name('complain.verify');
Route::get('complain/assets','ComplainController@get_assets');
Route::get('complain/locations','ComplainController@get_locations');
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
