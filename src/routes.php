<?php

Route::group( ['prefix' => config('watchtower.route_prefix') ], function () {

	/*
	|-------------------------------------------------------------------------
	|	Permission Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/permission/role/{role}/edit', 'Smarch\Watchtower\Controllers\PermissionController@editRole')->name('watchtower.permission.role.edit');
	Route::post('watchtower/permission/role/{role}', 'Smarch\Watchtower\Controllers\PermissionController@updateRole')->name('watchtower.permission.role.update');
	Route::resource('watchtower/permission', 'Smarch\Watchtower\Controllers\PermissionController',
		['names' => [
    		'create'	=> 'watchtower.permission.create',
    		'destroy'	=> 'watchtower.permission.destroy',
    		'edit'		=> 'watchtower.permission.edit',
    		'index'		=> 'watchtower.permission.index',
    		'show'		=> 'watchtower.permission.show',
    		'store'		=> 'watchtower.permission.store',
    		'update'	=> 'watchtower.permission.update'
			]
		]
	);


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
	Route::resource('watchtower/role', 'Smarch\Watchtower\Controllers\RoleController',
		['names' => [
    		'create'	=> 'watchtower.role.create',
    		'destroy'	=> 'watchtower.role.destroy',
    		'edit'		=> 'watchtower.role.edit',
    		'index'		=> 'watchtower.role.index',
    		'show'		=> 'watchtower.role.show',
    		'store'		=> 'watchtower.role.store',
    		'update'	=> 'watchtower.role.update'
			]
		]
	);


	/*
	|-------------------------------------------------------------------------
	|	User Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/user/matrix', 'Smarch\Watchtower\Controllers\UserController@showUserMatrix')->name('watchtower.user.matrix');
	Route::post('watchtower/user/matrix', 'Smarch\Watchtower\Controllers\UserController@updateUserMatrix')->name('watchtower.user.matrix');
	Route::get('watchtower/user/role/{user}/edit', 'Smarch\Watchtower\Controllers\UserController@editUserRoles')->name('watchtower.user.role.edit');
	Route::post('watchtower/user/role/{user}', 'Smarch\Watchtower\Controllers\UserController@updateUserRoles')->name('watchtower.user.role.update');
	Route::resource('watchtower/user', 'Smarch\Watchtower\Controllers\UserController',
		['names' => [
    		'create'	=> 'watchtower.user.create',
    		'destroy'	=> 'watchtower.user.destroy',
    		'edit'		=> 'watchtower.user.edit',
    		'index'		=> 'watchtower.user.index',
    		'show'		=> 'watchtower.user.show',
    		'store'		=> 'watchtower.user.store',
    		'update'	=> 'watchtower.user.update'
			]
		]
	);


	/*
	|-------------------------------------------------------------------------
	|	Watchtower Interface Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower', 'Smarch\Watchtower\Controllers\WatchtowerController@index')->name('watchtower.index');

});