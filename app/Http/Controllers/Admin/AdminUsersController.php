<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;

use App\Http\Requests\AdminUsersRequest;

use Flash;
use Alert;

class AdminUsersController extends Controller
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
//        $this->middleware('AdminUsersGuard');
    }

    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        // user search

        $name = $this->request->name;
        $email = $this->request->email;

        $users = new User;

        if (!empty($name)) {
        	$users = $users->name($name);
        }

        if (!empty($email)) {
        	$users = $users->email($email);
        }

        $users = $users->paginate(5);

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->getRoles();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function store(AdminUsersRequest $request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user->id) {

        	// save roles

        	$user->attachRoles($request->roles);

        	Flash::success(trans('admin/users.created'));

	        return redirect(route('admin.users.index'));

        }
        else
        {
        	Flash::error(trans('admin/general.created'));
        	return back()->withInput();
        }

    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function getRoles()
    {
        $roles = Role::lists('name','id');

        return $roles;
    }

    /**
     * Show the form for editing the specified resource.
     * GET /users/{id}/edit
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $roles = $this->getRoles();

        return view('admin.users.edit', compact('user','roles'));

    }

    /**
     * Update the specified resource in storage.
     * PUT /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(AdminUsersRequest $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($request->password)) {
	        $user->password = bcrypt($request->password);
        }

        $user->save();

        $user->roles()->sync($request->roles);

        Flash::success(trans('admin/users.updated'));
        // Alert::success('Success Message', 'Optional Title');
    	return back();
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

		$user->delete();

		if($this->request->ajax()){
            return response()->json(['result' => 'success', 'message' => trans('admin/users.destroyed'), 'flag' => 'Deleted!']);
        }
        else
        {
        	Flash::success(trans('admin/users.destroyed'));
	        return redirect(route('admin.users.index'));
        }


    }
}
