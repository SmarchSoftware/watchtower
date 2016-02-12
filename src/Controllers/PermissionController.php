<?php

namespace Smarch\Watchtower\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Shinobi;

use Smarch\Watchtower\Models\Role;
use Smarch\Watchtower\Models\Permission;

use Smarch\Watchtower\Requests\StoreRequest;
use Smarch\Watchtower\Requests\UpdateRequest;


class PermissionController extends Controller
{

	/**
	 * Set resource in constructor.
	 */
	function __construct() {
		$this->route = "permission";
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( Shinobi::can( config('watchtower.acl.permission.index', false) ) ) {
			$permissions = $this->getData();
			
			return view( config('watchtower.views.permissions.index'), compact('permissions') );
	 	}

	 	return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'view permission list' ]);
	}

	/**
	 * Returns paginated list of items, checks if filter used
	 * @return array Permissions
	 */
	protected function getData()
	{
		if ( \Request::has('search_value') ) {
			$value = \Request::get('search_value');
			$permissions = Permission::where('name', 'LIKE', '%'.$value.'%')
				->orWhere('slug', 'LIKE', '%'.$value.'%')
				->orWhere('description', 'LIKE', '%'.$value.'%')
				->orderBy('name')->paginate( config('watchtower.pagination.permissions', 15) );
			session()->flash('search_value', $value);
		} else {
			$permissions = Permission::orderBy('name')->paginate( config('watchtower.pagination.permissions', 15) );
			session()->forget('search_value');		
		}

		return $permissions;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if ( Shinobi::can( config('watchtower.acl.permission.create', false) ) ) {
			return view( config('watchtower.views.permissions.create') )
						->with('route', $this->route);
		}

		return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'create new permissions' ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoreRequest $request)
	{		
		$level = "danger";
		$message = " You are not permitted to create permissions.";

		if ( Shinobi::can ( config('watchtower.acl.permission.create', false) ) ) {
			Permission::create($request->all());
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Permission created.";
		}

		return redirect()->route( config('watchtower.route.as') .'permission.index')
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
		if ( Shinobi::canAtLeast( [ config('watchtower.acl.permission.edit', false),  config('watchtower.acl.permission.show', false)] ) ) {
			$resource = Permission::findOrFail($id);
			$show = "1";
			$route = $this->route;

			return view( config('watchtower.views.permissions.show'), compact('resource','show','route') );
		}

		return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'view permissions' ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if ( Shinobi::canAtLeast( [ config('watchtower.acl.permission.edit', false),  config('watchtower.acl.permission.show', false)] ) ) {
			$resource = Permission::findOrFail($id);
			$show = "0";
			$route = $this->route;

			return view( config('watchtower.views.permissions.edit'), compact('resource','show','route') );
		}

		return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'edit permissions' ]);
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
		$message = " You are not permitted to update permissions.";

		if ( Shinobi::can ( config('watchtower.acl.permission.edit', false) ) ) {
			$permission = Permission::findOrFail($id);
			$permission->update($request->all());
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Permission edited.";
		}

		return redirect()->route( config('watchtower.route.as') .'permission.index')
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
		$message = " You are not permitted to destroy permissions.";

		if ( Shinobi::can ( config('watchtower.acl.permission.destroy', false) ) ) {
			Permission::destroy($id);
			$level = "warning";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Permission deleted.";
		}

		return redirect()->route( config('watchtower.route.as') .'permission.index')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

	/**
	 * Show the form for editing the permission roles.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editRole($id)
	{
 		if ( Shinobi::can( config('watchtower.acl.permission.role', false) ) ) {
			$permission = Permission::findOrFail($id);

			$roles = $permission->roles;

	    	$available_roles = Role::whereDoesntHave('permissions', function ($query) use ($id) {
			    $query->where('permission_id', $id);
			})->get();

			return view( config('watchtower.views.permissions.role'), compact('permission', 'roles', 'available_roles') );
	 	}

	 	return view( config('watchtower.views.layouts.unauthorized'), [ 'message' => 'sync permission roles' ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateRole($id, Request $request)
	{
		$level = "danger";
		$message = " You are not permitted to update permissions.";

		if ( Shinobi::can ( config('watchtower.acl.permission.role', false) ) ) {
			$permission = Permission::findOrFail($id);
			if ($request->has('slug')) {
				$permission->roles()->sync( $request->get('slug') );
			} else {
				$permission->roles()->detach();
			}
			$level = "success";
			$message = "<i class='fa fa-check-square-o fa-1x'></i> Success! Permission roles edited.";
		}

		return redirect()->route( config('watchtower.route.as') .'permission.index')
				->with( ['flash' => ['message' => $message, 'level' =>  $level] ] );
	}

}
