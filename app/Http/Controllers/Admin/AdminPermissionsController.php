<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Permission;

use App\Http\Requests\AdminPermissionsRequest;

use Flash;
use Alert;

class AdminPermissionsController extends Controller
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
//        $this->middleware('AdminPermissionsGuard');
    }

    /**
     * Display a listing of the resource.
     * GET /permissions
     *
     * @return Response
     */
    public function index()
    {
        // permssion search

        $name = $this->request->name;

        $permissions = new Permission;

        if (!empty($name)) {
        	$permissions = $permissions->name($name);
        }

        $permissions = $permissions->paginate(5);

        return view('admin.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /permissions/create
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /permissions
     *
     * @return Response
     */
    public function store(AdminPermissionsRequest $request)
    {
        $permission = new Permission;

        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->save();

        if ($permission->id) {

        	Flash::success(trans('admin/permissions.created'));

	        return redirect(route('admin.permissions.index'));

        }
        else
        {
        	Flash::error(trans('admin/general.created'));
        	return back()->withInput();
        }

    }

    /**
     * Show the form for editing the specified resource.
     * GET /permissions/{id}/edit
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     * PUT /permissions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(AdminPermissionsRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $permission->name = $request->name;
        $permission->display_name = $request->display_name;

        $permission->save();

        Flash::success(trans('admin/permissions.updated'));
        // Alert::success('Success Message', 'Optional Title');
    	return back();
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /permissions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

		$permission->delete();

		if($this->request->ajax()){
            return response()->json(['result' => 'success', 'message' => trans('admin/permissions.destroyed'), 'flag' => 'Deleted!']);
        }
        else
        {
        	Flash::success(trans('admin/permissions.destroyed'));
	        return redirect(route('admin.permissions.index'));
        }

    }
}
