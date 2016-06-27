<?php

Route::group( [ 
		'middleware'=> config('watchtower.route.middleware'),
		'prefix'	=> config('watchtower.route.prefix'),
		'as'		=> config('watchtower.route.as')
	  ], function () {

	/*
	|-------------------------------------------------------------------------
	|	Permission Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/permission/role/{role}/edit', 'EliteTelecom\Watchtower\Controllers\PermissionController@editRole')->name('permission.role.edit');
	Route::post('watchtower/permission/role/{role}', 'EliteTelecom\Watchtower\Controllers\PermissionController@updateRole')->name('permission.role.update');
	Route::resource('watchtower/permission', 'EliteTelecom\Watchtower\Controllers\PermissionController',
		['names' => [
    		'create'	=> 'permission.create',
    		'destroy'	=> 'permission.destroy',
    		'edit'		=> 'permission.edit',
    		'index'		=> 'permission.index',
    		'show'		=> 'permission.show',
    		'store'		=> 'permission.store',
    		'update'	=> 'permission.update'
			]
		]
	);


	/*
	|-------------------------------------------------------------------------
	|	Role Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/role/matrix', 'EliteTelecom\Watchtower\Controllers\RoleController@showRoleMatrix')->name('role.matrix');
	Route::post('watchtower/role/matrix', 'EliteTelecom\Watchtower\Controllers\RoleController@updateRoleMatrix')->name('role.matrix');
	Route::get('watchtower/role/permission/{role}/edit', 'EliteTelecom\Watchtower\Controllers\RoleController@editRolePermissions')->name('role.permission.edit');
	Route::post('watchtower/role/permission/{role}', 'EliteTelecom\Watchtower\Controllers\RoleController@updateRolePermissions')->name('role.permission.update');
	Route::get('watchtower/role/user/{role}/edit', 'EliteTelecom\Watchtower\Controllers\RoleController@editRoleUsers')->name('role.user.edit');
	Route::post('watchtower/role/user/{role}', 'EliteTelecom\Watchtower\Controllers\RoleController@updateRoleUsers')->name('role.user.update');
	Route::resource('watchtower/role', 'EliteTelecom\Watchtower\Controllers\RoleController',
		['names' => [
    		'create'	=> 'role.create',
    		'destroy'	=> 'role.destroy',
    		'edit'		=> 'role.edit',
    		'index'		=> 'role.index',
    		'show'		=> 'role.show',
    		'store'		=> 'role.store',
    		'update'	=> 'role.update'
			]
		]
	);


	/*
	|-------------------------------------------------------------------------
	|	User Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/user/matrix', 'EliteTelecom\Watchtower\Controllers\UserController@showUserMatrix')->name('user.matrix');
	Route::post('watchtower/user/matrix', 'EliteTelecom\Watchtower\Controllers\UserController@updateUserMatrix')->name('user.matrix');
	Route::get('watchtower/user/role/{user}/edit', 'EliteTelecom\Watchtower\Controllers\UserController@editUserRoles')->name('user.role.edit');
	Route::post('watchtower/user/role/{user}', 'EliteTelecom\Watchtower\Controllers\UserController@updateUserRoles')->name('user.role.update');
	Route::resource('watchtower/user', 'EliteTelecom\Watchtower\Controllers\UserController',
		['names' => [
    		'create'	=> 'user.create',
    		'destroy'	=> 'user.destroy',
    		'edit'		=> 'user.edit',
    		'index'		=> 'user.index',
    		'show'		=> 'user.show',
    		'store'		=> 'user.store',
    		'update'	=> 'user.update'
			]
		]
	);


	/*
	|-------------------------------------------------------------------------
	|	Watchtower Interface Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower', 'EliteTelecom\Watchtower\Controllers\WatchtowerController@index')->name('index');

});