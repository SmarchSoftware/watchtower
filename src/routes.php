<?php

Route::group(['middleware' => 'web'], function () {
	/*
	|-------------------------------------------------------------------------
	|	Permission Routes
	|-------------------------------------------------------------------------
	*/
	Route::resource('watchtower/permission', 'Smarch\Watchtower\Controllers\PermissionController');
	Route::get('watchtower/permission/role/{role}/edit', 'Smarch\Watchtower\Controllers\PermissionController@editRole')->name('watchtower.permission.role.edit');
	Route::post('watchtower/permission/role/{role}', 'Smarch\Watchtower\Controllers\PermissionController@updateRole')->name('watchtower.permission.role.update');


	/*
	|-------------------------------------------------------------------------
	|	Role Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/role/matrix', 'Smarch\Watchtower\Controllers\RoleController@showRoleMatrix')->name('watchtower.role.matrix');
	Route::post('watchtower/role/matrix', 'Smarch\Watchtower\Controllers\RoleController@updateRoleMatrix')->name('watchtower.role.matrix');
	Route::get('watchtower/role/permission/{role}/edit', 'Smarch\Watchtower\Controllers\RoleController@editRolePermissions')->name('watchtower.role.permission.edit');
	Route::post('watchtower/role/permission/{role}', 'Smarch\Watchtower\Controllers\RoleController@updateRolePermissions')->name('watchtower.role.permission.update');
	Route::get('watchtower/role/user/{role}/edit', 'Smarch\Watchtower\Controllers\RoleController@editRoleUsers')->name('watchtower.role.user.edit');
	Route::post('watchtower/role/user/{role}', 'Smarch\Watchtower\Controllers\RoleController@updateRoleUsers')->name('watchtower.role.user.update');
	Route::resource('watchtower/role', 'Smarch\Watchtower\Controllers\RoleController');


	/*
	|-------------------------------------------------------------------------
	|	User Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/user/matrix', 'Smarch\Watchtower\Controllers\UserController@showUserMatrix')->name('watchtower.user.matrix');
	Route::post('watchtower/user/matrix', 'Smarch\Watchtower\Controllers\UserController@updateUserMatrix')->name('watchtower.user.matrix');
	Route::get('watchtower/user/role/{user}/edit', 'Smarch\Watchtower\Controllers\UserController@editUserRoles')->name('watchtower.user.role.edit');
	Route::post('watchtower/user/role/{user}', 'Smarch\Watchtower\Controllers\UserController@updateUserRoles')->name('watchtower.user.role.update');
	Route::resource('watchtower/user', 'Smarch\Watchtower\Controllers\UserController');


	/*
	|-------------------------------------------------------------------------
	|	Watchtower Interface Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower', 'Smarch\Watchtower\Controllers\WatchtowerController@index')->name('watchtower.index');

});