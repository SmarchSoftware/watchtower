<?php

Route::group( [ 
		'middleware'=> config('watchtower.route.middleware'),
		'as'		=> config('watchtower.route.as')
	  ], function () {

	/*
	|-------------------------------------------------------------------------
	|	Permission Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/permission/role/{role}/edit', 'Smarch\Watchtower\Controllers\PermissionController@editRole')->name( config('watchtower.route.prefix') . 'permission.role.edit');
	Route::post('watchtower/permission/role/{role}', 'Smarch\Watchtower\Controllers\PermissionController@updateRole')->name( config('watchtower.route.prefix') . 'permission.role.update');
	Route::resource('watchtower/permission', 'Smarch\Watchtower\Controllers\PermissionController',
		['names' => [
    		'create'	=> config('watchtower.route.prefix') . 'permission.create',
    		'destroy'	=> config('watchtower.route.prefix') . 'permission.destroy',
    		'edit'		=> config('watchtower.route.prefix') . 'permission.edit',
    		'index'		=> config('watchtower.route.prefix') . 'permission.index',
    		'show'		=> config('watchtower.route.prefix') . 'permission.show',
    		'store'		=> config('watchtower.route.prefix') . 'permission.store',
    		'update'	=> config('watchtower.route.prefix') . 'permission.update'
			]
		]
	);


	/*
	|-------------------------------------------------------------------------
	|	Role Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/role/matrix', 'Smarch\Watchtower\Controllers\RoleController@showRoleMatrix')->name( config('watchtower.route.prefix') . 'role.matrix');
	Route::post('watchtower/role/matrix', 'Smarch\Watchtower\Controllers\RoleController@updateRoleMatrix')->name( config('watchtower.route.prefix') . 'role.matrix');
	Route::get('watchtower/role/permission/{role}/edit', 'Smarch\Watchtower\Controllers\RoleController@editRolePermissions')->name( config('watchtower.route.prefix') . 'role.permission.edit');
	Route::post('watchtower/role/permission/{role}', 'Smarch\Watchtower\Controllers\RoleController@updateRolePermissions')->name( config('watchtower.route.prefix') . 'role.permission.update');
	Route::get('watchtower/role/user/{role}/edit', 'Smarch\Watchtower\Controllers\RoleController@editRoleUsers')->name( config('watchtower.route.prefix') . 'role.user.edit');
	Route::post('watchtower/role/user/{role}', 'Smarch\Watchtower\Controllers\RoleController@updateRoleUsers')->name( config('watchtower.route.prefix') . 'role.user.update');
	Route::resource('watchtower/role', 'Smarch\Watchtower\Controllers\RoleController',
		['names' => [
    		'create'	=> config('watchtower.route.prefix') . 'role.create',
    		'destroy'	=> config('watchtower.route.prefix') . 'role.destroy',
    		'edit'		=> config('watchtower.route.prefix') . 'role.edit',
    		'index'		=> config('watchtower.route.prefix') . 'role.index',
    		'show'		=> config('watchtower.route.prefix') . 'role.show',
    		'store'		=> config('watchtower.route.prefix') . 'role.store',
    		'update'	=> config('watchtower.route.prefix') . 'role.update'
			]
		]
	);


	/*
	|-------------------------------------------------------------------------
	|	User Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower/user/matrix', 'Smarch\Watchtower\Controllers\UserController@showUserMatrix')->name( config('watchtower.route.prefix') . 'user.matrix');
	Route::post('watchtower/user/matrix', 'Smarch\Watchtower\Controllers\UserController@updateUserMatrix')->name( config('watchtower.route.prefix') . 'user.matrix');
	Route::get('watchtower/user/role/{user}/edit', 'Smarch\Watchtower\Controllers\UserController@editUserRoles')->name( config('watchtower.route.prefix') . 'user.role.edit');
	Route::post('watchtower/user/role/{user}', 'Smarch\Watchtower\Controllers\UserController@updateUserRoles')->name( config('watchtower.route.prefix') . 'user.role.update');
	Route::resource('watchtower/user', 'Smarch\Watchtower\Controllers\UserController',
		['names' => [
    		'create'	=> config('watchtower.route.prefix') . 'user.create',
    		'destroy'	=> config('watchtower.route.prefix') . 'user.destroy',
    		'edit'		=> config('watchtower.route.prefix') . 'user.edit',
    		'index'		=> config('watchtower.route.prefix') . 'user.index',
    		'show'		=> config('watchtower.route.prefix') . 'user.show',
    		'store'		=> config('watchtower.route.prefix') . 'user.store',
    		'update'	=> config('watchtower.route.prefix') . 'user.update'
			]
		]
	);


	/*
	|-------------------------------------------------------------------------
	|	Watchtower Interface Routes
	|-------------------------------------------------------------------------
	*/
	Route::get('watchtower', 'Smarch\Watchtower\Controllers\WatchtowerController@index')->name( config('watchtower.route.prefix') . 'index');

});