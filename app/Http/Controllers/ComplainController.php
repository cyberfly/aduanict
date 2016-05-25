<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Complain;
use App\User;

use Validator;
use App\Http\Requests\ComplainRequest;
use Auth;

class ComplainController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $complains = Complain::paginate(20);

        return view('complains/index',compact('complains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //prepare users record for dropdown

        $users = User::where('id','!=',Auth::user()->id)->lists('name','id');

        $users = array(''=>'Pilih Pengguna') + $users->all();

        return view('complains/create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplainRequest $request)
    {
        $emp_id_aduan = Auth::user()->id;

        $aduan = $request->aduan;
        $login_daftar = $request->login_daftar;

        if (empty($login_daftar))
        {
            $login_daftar = Auth::user()->id;
        }

        //initilize complain object

        $complain = new Complain;
        $complain->emp_id_aduan = $emp_id_aduan;
        $complain->aduan = $aduan;
        $complain->login_daftar = $login_daftar;

        //save complain object

        $complain->save();

        //after success, redirect to index

        return redirect(route('complain.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('complains/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complain = Complain::find($id);

        return view('complains/edit',compact('complain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComplainRequest $request, $id)
    {
        $aduan = $request->aduan;
        
        $complain = Complain::find($id);

        $complain->aduan = $aduan;
        
        $complain->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complain = Complain::find($id);
        $complain->delete();

        return back();
    }
}
