<?php

namespace Smarch\Watchtower\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;
use Shinobi;

use Smarch\Watchtower\Models\Role;
use Smarch\Watchtower\Models\User;
use Smarch\Watchtower\Models\Permission;

use Smarch\Watchtower\Requests\StoreRequest;
use Smarch\Watchtower\Requests\UpdateRequest;

class RoleController extends Controller
{
	
	/**
	 * Set resource in constructor.
	 */
	function __construct() {
		$this->route = "role";
		$this->table = "roles";
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if ( $request->has('search_value') ) {
			$value = $request->get('search_value');
			$roles = Role::where('name', 'LIKE', '%'.$value.'%')
				->orWhere('slug', 'LIKE', '%'.$value.'%')
				->orWhere('description', 'LIKE', '%'.$value.'%')
				->orderBy('name')->paginate( config('watchtower.pagination.roles', 15) );
		} else {
			$roles = Role::orderBy('name')->paginate( config('watchtower.pagination.roles', 15) );
		}
		
		return view( config('watchtower.views.roles.index'), compact('roles', 'value') );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view( config('watchtower.views.roles.create') )
					->with('route', $this->route)
					->with('tbl', $this->table);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoreRequest $request)
	{		
		$level = "danger";
		$message = " You are not permitted to create roles.";

		if ( Shinobi::can ( config('watchtower.acl.role.create', false) ) ) {
			Role::create($request->all());
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Role created.";
		}

		return redirect()->route('watchtower.role.index')
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
		$resource = Role::findOrFail($id);
		$show = "1";
		$route = $this->route;
		return view( config('watchtower.views.roles.show'), compact('resource','show','route') );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$resource = Role::findOrFail($id);
		$show = "0";
		$route = $this->route;
		$tbl = $this->table;

		return view( config('watchtower.views.roles.edit'), compact('resource','show','route','tbl') );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, UpdateRequest $request)
	{		
		$level = "danger";
		$message = " You are not permitted to update roles.";

		if ( Shinobi::can ( config('watchtower.acl.role.edit', false) ) ) {
			$role = Role::findOrFail($id);
			$role->update($request->all());
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Role edited.";
		}

		return redirect()->route('watchtower.role.index')
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
		$message = " You are not permitted to destroy roles.";

		if ( Shinobi::can ( config('watchtower.acl.role.destroy', false) ) ) {
			Role::destroy($id);
			$level = "warning";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Role deleted.";
		}

		return redirect()->route('watchtower.role.index')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

	/**
	 * Show the form for editing the role permissions.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editRolePermissions($id)
	{
		$role = Role::findOrFail($id);

		$permissions = $role->permissions;

    	$available_permissions = Permission::whereDoesntHave('roles', function ($query) use ($id) {
		    $query->where('role_id', $id);
		})->get();

		return view( config('watchtower.views.roles.permission'), compact('role', 'permissions', 'available_permissions') );
	}

	/**
	 * Sync roles and permissions.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateRolePermissions($id, Request $request)
	{
		$level = "danger";
		$message = " You are not permitted to update role permissions.";

		if ( Shinobi::can ( config('watchtower.acl.role.permissions', false) ) ) {
			$role = Role::findOrFail($id);
			if ($request->has('slug')) {
				$role->permissions()->sync( $request->get('slug') );
			} else {
				$role->permissions()->detach();
			}
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Role permissions updated.";
		}

		return redirect()->route('watchtower.role.index')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

	/**
	 * Show the form for editing the role users.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editRoleUsers($id)
	{
		$role = Role::findOrFail($id);

		$users = $role->users;

    	$available_users = User::whereDoesntHave('roles', function ($query) use ($id) {
		    $query->where('role_id', $id);
		})->get();

		return view( config('watchtower.views.roles.user'), compact('role', 'users', 'available_users') );
	}

	/**
	 * Sync roles and users.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateRoleUsers($id, Request $request)
	{
		$level = "danger";
		$message = " You are not permitted to update role users.";

		if ( Shinobi::can ( config('watchtower.acl.role.users', false) ) ) {
			$role = Role::findOrFail($id);
			if ($request->has('slug')) {
				$role->users()->sync( $request->get('slug') );
			} else {
				$role->users()->detach();
			}
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Role users updated.";
		}

		return redirect()->route('watchtower.role.index')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

	/**
	 * A full matrix of roles and permissions.
	 * @return Response
	 */
	public function showRoleMatrix()
	{
		$roles = Role::all();
		$perms = Permission::all();
		$prs = DB::table('permission_role')->select('role_id as r_id','permission_id as p_id')->get();

		$pivot = [];
		foreach($prs as $p) {
			$pivot[] = $p->r_id.":".$p->p_id;
		}

		return view( config('watchtower.views.roles.rolematrix'), compact('roles','perms','pivot') );
	}

	/**
	 * Sync roles and permissions.
	 * @return Response
	 */
	public function updateRoleMatrix(Request $request)
	{		
		$level = "danger";
		$message = " You are not permitted to update role permissions.";

		if ( Shinobi::can ( config('watchtower.acl.role.permissions', false) ) ) {
			$bits = $request->get('perm_role');
			foreach($bits as $v) {
				$p = explode(":", $v);
				$data[] = array('role_id' => $p[0], 'permission_id' => $p[1]);
			}
			
			DB::transaction(function () use ($data) {
				DB::table('permission_role')->delete();
				DB::statement('ALTER TABLE permission_role AUTO_INCREMENT = 1');
				DB::table('permission_role')->insert($data);
			});

			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Role permissions updated.";
		}

		return redirect()->route('watchtower.role.matrix')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}


}
