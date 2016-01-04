<?php

namespace Smarch\Watchtower\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;
use Shinobi;

use Smarch\Watchtower\Models\User;
use Smarch\Watchtower\Models\Role;
use Smarch\Watchtower\Requests\UserStoreRequest;
use Smarch\Watchtower\Requests\UserUpdateRequest;

class UserController extends Controller
{

	/**
	 * Set resource in constructor.
	 */
	function __construct() {}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
  		if ( Shinobi::can( config('watchtower.acl.user.index', false) ) ) {
			if ( $request->has('search_value') ) {
				$value = $request->get('search_value');
				$users = User::where('name', 'LIKE', '%'.$value.'%')
					->orderBy('name')->paginate( config('watchtower.pagination.users', 15) );
				session()->flash('search_value', $value);
			} else {
				$users = User::orderBy('name')->paginate( config('watchtower.pagination.users', 15) );
				session()->forget('search_value');	
			}
			
			return view( config('watchtower.views.users.index'), compact('users') );
	 	}

	 	return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'view user list' ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	 	if ( Shinobi::can( config('watchtower.acl.user.create', false) ) ) {
			return view( config('watchtower.views.users.create') );
	 	}

	 	return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'create new users' ]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserStoreRequest $request)
	{
		$level = "danger";
		$message = " You are not permitted to create users.";

		if ( Shinobi::can ( config('watchtower.acl.user.create', false) ) ) {
			User::create($request->all());
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! User created.";
		}

		return redirect()->route('watchtower.user.index')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
  		if ( Shinobi::canAtLeast( [ config('watchtower.acl.user.show', false),  config('watchtower.acl.user.edit', false) ] ) ) {
			$resource = User::findOrFail($id);
			$show = "1";
			return view( config('watchtower.views.users.show'), compact('resource','show') );
	 	}

	 	return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'view users' ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
  		if ( Shinobi::canAtLeast( [ config('watchtower.acl.user.edit', false),  config('watchtower.acl.user.show', false) ] ) ) {
			$resource = User::findOrFail($id);
			$show = "0";
			return view( config('watchtower.views.users.edit'), compact('resource','show') );
	 	}

	 	return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'edit users' ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, UserUpdateRequest $request)
	{
		$level = "danger";
		$message = " You are not permitted to update users.";

		if ( Shinobi::can ( config('watchtower.acl.user.edit', false) ) ) {
			$user = User::findOrFail($id);
			$user->update($request->all());
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! User edited.";
		}
		
		return redirect()->route('watchtower.user.index')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$level = "danger";
		$message = " You are not permitted to destroy user objects";

		if ( Shinobi::can ( config('watchtower.acl.user.destroy', false) ) ) {
			User::destroy($id);
			$level = "warning";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! User deleted.";
		}

		return redirect()->route('watchtower.user.index')
					->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

	/**
	 * Show the form for editing the user roles.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editUserRoles($id)
	{
  		if ( \Shinobi::can( config('watchtower.acl.user.role', false) ) ) {
			$user = User::findOrFail($id);

			$roles = $user->roles;

			foreach ($roles as $role) {
				$permissions[$role->name] = $role->permissions;
			}

	    	$available_roles = Role::whereDoesntHave('users', function ($query) use ($id) {
			    $query->where('user_id', $id);
			})->get();

			return view( config('watchtower.views.users.role'), compact('user', 'roles', 'available_roles', 'permissions') );
		}

	 	return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'sync user roles' ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateUserRoles($id, Request $request)
	{
		$level = "danger";
		$message = " You are not permitted to update user roles.";

		if ( Shinobi::can ( config('watchtower.acl.user.role', false) ) ) {
			$user = User::findOrFail($id);
			if ($request->has('ids')) {
				$user->roles()->sync( $request->get('ids') );
			} else {
				$user->roles()->detach();
			}
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! User roles edited.";
		}

		return redirect()->route('watchtower.user.index')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

	/**
	 * [userMatrix description]
	 * @return Response
	 */
	public function showUserMatrix()
	{
  		if ( \Shinobi::can( config('watchtower.acl.user.viewmatrix', false) ) ) {
			$roles = Role::all();
			$users = User::all();
			$us = DB::table('role_user')->select('role_id as r_id','user_id as u_id')->get();

			$pivot = [];
			foreach($us as $u) {
				$pivot[] = $u->r_id.":".$u->u_id;
			}

			return view( config('watchtower.views.users.usermatrix'), compact('roles','users','pivot') );
		}

	 	return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'sync user roles' ]);
	}

	/**
	 * [updateMatrix description]
	 * @return Response
	 */
	public function updateUserMatrix(Request $request)
	{		
		$level = "danger";
		$message = " You are not permitted to update user roles.";

		if ( Shinobi::can ( config('watchtower.acl.user.usermatrix', false) ) ) {
			$bits = $request->get('role_user');
			foreach($bits as $v) {
				$p = explode(":", $v);
				$data[] = array('role_id' => $p[0], 'user_id' => $p[1]);
			}
			
			DB::transaction(function () use ($data) {
				DB::table('role_user')->delete();
				DB::statement('ALTER TABLE role_user AUTO_INCREMENT = 1');
				DB::table('role_user')->insert($data);
			});
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! User roles updated.";
		}

		return redirect()->route('watchtower.user.matrix')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

}
