<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Permission;

use App\Http\Requests\AdminRolesRequest;

use Flash;
use Alert;

class AdminRolesController extends Controller
{

    /**
     * Create a new AdminUsersController instance.
     *
     * @param Request $request
     * @param UserGateway $gateway
     * @param Config $config
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth');
//        $this->middleware('AdminRolesGuard');
    }

    /**
     * Display a listing of the resource.
     * GET /roles
     *
     * @return Response
     */
    public function index()
    {
        // role search

        $name = $this->request->name;

        // $roles = new Role;
        $roles = Role::with('perms');

        if (!empty($name)) {
        	$roles = $roles->name($name);
        }

        $roles = $roles->paginate(5);

        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /roles/create
     *
     * @return Response
     */
    public function create()
    {
        $permissions = $this->getPermissions();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /roles
     *
     * @return Response
     */
    public function store(AdminRolesRequest $request)
    {
        $role = new Role;

        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->save();

        if ($role->id) {

        	// save permissions

        	$role->attachPermissions($request->permissions);

        	Flash::success(trans('admin/roles.created'));

	        return redirect(route('admin.roles.index'));

        }
        else
        {
        	Flash::error(trans('admin/general.created'));
        	return back()->withInput();
        }

    }

    /**
     * Show the form for creating a new resource.
     * GET /roles/create
     *
     * @return Response
     */
    public function getPermissions()
    {
        $permissions = Permission::lists('display_name','id');

        return $permissions;
    }

    /**
     * Show the form for editing the specified resource.
     * GET /roles/{id}/edit
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $permissions = $this->getPermissions();

        return view('admin.roles.edit', compact('role','permissions'));

    }

    /**
     * Update the specified resource in storage.
     * PUT /roles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(AdminRolesRequest $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->name = $request->name;
        $role->display_name = $request->display_name;

        $role->save();

        $role->perms()->sync($request->permissions);

        Flash::success(trans('admin/roles.updated'));
        // Alert::success('Success Message', 'Optional Title');
    	return back();
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /roles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

		$role->delete();

		if($this->request->ajax()){
            return response()->json(['result' => 'success', 'message' => trans('admin/roles.destroyed'), 'flag' => 'Deleted!']);
        }
        else
        {
        	Flash::success(trans('admin/roles.destroyed'));
	        return redirect(route('admin.roles.index'));
        }
    }
}
