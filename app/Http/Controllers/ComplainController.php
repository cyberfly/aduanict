<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Complain;
use App\User;
use App\ComplainSource;
use App\ComplainCategory;

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

        //prepare complain category for dropdown

        $complain_categories = $this->get_complain_categories();

        //prepare complain source for dropdown

        $complain_sources = $this->get_complain_sources();

        return view('complains/create',compact('users','complain_categories','complain_sources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplainRequest $request)
    {
        $user_id = Auth::user()->id;

        $complain_description = $request->complain_description;
        $user_emp_id = $request->user_emp_id;

        if (empty($user_emp_id))
        {
            $user_emp_id = Auth::user()->id;
        }

        //initilize complain object

        $complain = new Complain;
        $complain->user_id = $user_id;
        $complain->complain_description = $complain_description;
        $complain->user_emp_id = $user_emp_id;

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
        $complain_description = $request->complain_description;
        
        $complain = Complain::find($id);

        $complain->complain_description = $complain_description;
        
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

    /*
     * Get complain categories
     * */

    function get_complain_categories()
    {
        //prepare complain category for dropdown

        $complain_categories = ComplainCategory::lists('description','category_id');

        $complain_categories = array(''=>'Pilih Kategori') + $complain_categories->all();

        return $complain_categories;
    }

    function get_complain_sources()
    {
        $complain_sources = ComplainSource::lists('description','source_id');

        $complain_sources = array(''=>'Pilih Kaedah') + $complain_sources->all();

        return $complain_sources;
    }
}
