<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetsLocation;
use App\Branch;
use App\ComplainAction;
use App\ComplainStatus;
use App\Events\ComplainAssignStaff;
use App\Events\ComplainCreated;
use App\Events\ComplainHelpdeskAction;
use App\Events\ComplainTechnicalAction;
use App\Events\ComplainUserVerify;
use App\KodUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Complain;
use App\User;
use App\ComplainSource;
use App\ComplainCategory;

use Illuminate\Support\Facades\DB;
use Event;
use Validator;
use App\Http\Requests\ComplainRequest;
use Auth;
use Entrust;
use Flash;

class ComplainController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $this->user_id = 0;
        $this->unit_id = 0;

        if (Auth::check()) {
            $this->user_id = Auth::user()->id;
            $this->unit_id = Auth::user()->kod_id;
        }

        //guna ni for function that do not have Request

        $this->request = $request;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Entrust::hasRole('members'))
        {
            /*
             * 1. Filter by user_emp_id
             * 2. Or filter by action_emp_id
             * 3. Or user_id
             * */


            $complains = Complain::where('user_emp_id',$this->user_id)->
                                    orWhere('action_emp_id', $this->user_id)->
                                    orWhere('user_id', $this->user_id)->
                                    orderBy('complain_id','desc')->
                                    paginate(20);
        }
        else if (Entrust::hasRole('unit_manager'))
        {

            $complains = Complain::where('user_emp_id',$this->user_id)->
            orWhere('action_emp_id', $this->user_id)->
            orWhere('user_id', $this->user_id)->
            orWhere('unit_id', $this->unit_id)->
            orderBy('complain_id','desc')->
            paginate(20);
        }
        else
        {
            $complains = Complain::orderBy('complain_id','desc')->paginate(20);
        }

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

        //prepare locations dropdown

        $locations = $this->get_locations();

        //prepare branch dropdown

        $branches = $this->get_branches();

        //prepare assets dropdown

        $assets = $this->get_assets();

        return view('complains/create',compact('users','complain_categories','complain_sources','locations','branches','assets'));
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

        $category_explode = explode('-', $request->complain_category_id);

        $complain_category_id = $category_explode[0];
        $unit_id = $category_explode[1];

        $complain->complain_category_id = $complain_category_id;
        $complain->unit_id = $unit_id;

        $complain->complain_source_id = $request->complain_source_id;
        $complain->complain_status_id = 1;

        $aduan_category_exception_value = array('5','6');

        if (!in_array($request->complain_category_id,$aduan_category_exception_value))
        {
            //$complain->branch_id = $request->branch_id;
            $complain->lokasi_id = $request->lokasi_id;
            $complain->ict_no = $request->ict_no;
        }
        else
        {
            //$complain->branch_id = null;
            $complain->lokasi_id = null;
            $complain->ict_no = null;
        }

        //save complain object

        $complain->save();

        //event success complain

        Event::fire(new ComplainCreated($complain));

        //after success, redirect to index

        if($request->ajax()){

            return response()->json(array('flag'=>'Tahniah',
                                'message'=>'Aduan berjaya di hantar',
                                'result'=>'success',
                                'redirect'=>url('complain'))
                                );

        }
        else{

            Flash::success('Aduan berjaya di hantar');
            return redirect(route('complain.index'));
        }

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

        $complain_statuses = ComplainStatus::lists('description','status_id');

        //prepare complain category for dropdown

        $complain_categories = $this->get_complain_categories();

        //prepare complain source for dropdown

        $complain_sources = $this->get_complain_sources();

        //prepare locations dropdown

        $complain_branch_id = $complain->assets_location->branch_id;

        $location_filter = array('branch_id'=>$complain_branch_id);

        $locations = $this->get_locations($location_filter);

        //prepare branch dropdown

        $branches = $this->get_branches();

        //prepare assets dropdown

        $assets = $this->get_assets();

        $complain_actions = $this->get_complain_actions($id);

        return view('complains/edit',compact('complain','complain_statuses','complain_actions','complain_categories','complain_sources','locations','branches','assets'));
    }

    public function get_complain_actions($id)
    {
        $complain_actions = Complain::find($id)->complain_action()->orderBy('id','desc')->get();

        return $complain_actions;
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
        $complain = Complain::find($id);

        //kalau TEKNIKAL EDIT FORM, tak perlu kategori id
        //exclude_category from hidden field

        if (!$request->has('exclude_category'))
        {
            $category_explode = explode('-', $request->complain_category_id);

            $complain_category_id = $category_explode[0];
            $unit_id = $category_explode[1];

            $complain->complain_category_id = $complain_category_id;
            $complain->unit_id = $unit_id;
        }

        $complain->lokasi_id = $request->lokasi_id;
        $complain->ict_no = $request->ict_no;

        $complain->save();

        Flash::success('Berjaya dikemaskinikan');

        return back();
    }

    /*
     * Pengadu verify whether the complain Status P have been solved, or not
     * */

    public function verify(Request $request, $id)
    {
        $submit_type = $request->submit_type;

        $complain = Complain::find($id);

        $complain->user_comment = $request->user_comment;
        $complain->verify_date = Carbon::now();
        $complain->verify_emp_id = $this->user_id;

        if ($submit_type=='finish')
        {
            $complain_status_id = 4;
            $complain->verify_status = 1;
            $complain->complain_status_id = $complain_status_id;
        }
        else if ($submit_type=='reject')
        {
            $complain_status_id = 2;
            $complain->verify_status = 2;
            $complain->complain_status_id = $complain_status_id;

        }

        $complain->save();

        //user verify event

        Event::fire(new ComplainUserVerify($complain));

        //simpan sebagai history

        $complain_action = new ComplainAction;
        $complain_action->complain_id = $id;
        $complain_action->user_emp_id = $this->user_id;
        $complain_action->complain_status_id = $complain_status_id;
        $complain_action->user_comment = $request->user_comment;

        $complain_action->save();

        return back();
    }

    /*
     * Tindakan helpdesk view
     * */

    public function action($id)
    {
        $complain = Complain::find($id);

        $complain_statuses = ComplainStatus::lists('description','status_id');

        //prepare complain category for dropdown

        $complain_categories = $this->get_complain_categories();

        //prepare complain source for dropdown

        $complain_sources = $this->get_complain_sources();

        //prepare locations dropdown

        $locations = $this->get_locations();

        //prepare branch dropdown

        $branches = $this->get_branches();

        //prepare assets dropdown

        $assets = $this->get_assets();

        //prepare kod units dropdown

        $kod_units = $this->get_kod_unit();

        $complain_actions = $this->get_complain_actions($id);

        return view('complains/action',compact('complain','complain_statuses','complain_actions','complain_categories','complain_sources','locations','branches','assets','kod_units'));
    }

    /*
     * Tindakan helpdesk update action
     * */

    public function update_action(ComplainRequest $request, $id)
    {
        $complain = Complain::find($id);

        if ($request->submit_type=='finish')
        {
            $complain_status_id = 5;
            $complain->complain_status_id = $complain_status_id;
        }
        else
        {
            $complain->action_comment = $request->action_comment;
            $complain->helpdesk_delay_reason = $request->delay_reason;
            $complain->action_date = Carbon::now();
            $complain_status_id = $request->complain_status_id;
            $complain->complain_status_id = $complain_status_id;
        }

        //kalau helpdesk assign kepada unit manager, update assign date

        if ($request->complain_status_id==7)
        {
            $complain->assign_date = Carbon::now();
        }

        $complain->save();

        //event when helpdesk submit action

        Event::fire(new ComplainHelpdeskAction($complain));

        //insert into complain action as logs

        $complain_action = new ComplainAction;
        $complain_action->complain_id = $id;

        $complain_action->complain_status_id = $complain_status_id;

        $complain_action->action_by = $this->user_id;

        if ($request->submit_type=='finish')
        {
            $complain_action->action_comment = 'selesai';
        }
        else{
            $complain_action->action_comment = $request->action_comment;
        }

        $complain_action->delay_reason = $request->delay_reason;

        $complain_action->save();


        return back();
    }

    /*
     * Tindakan helpdesk view
     * */

    public function technical_action($id)
    {
        $complain = Complain::find($id);

        //hanya paparkan dropdown status TINDAKAN atau SAHKAN (P)

        $complain_statuses = ComplainStatus::where('status_id','2')->
                            orWhere('status_id','3')->
                            lists('description','status_id');

        //prepare complain category for dropdown

        $complain_categories = $this->get_complain_categories();

        //prepare complain source for dropdown

        $complain_sources = $this->get_complain_sources();

        //prepare locations dropdown

        $locations = $this->get_locations();

        //prepare branch dropdown

        $branches = $this->get_branches();

        //prepare assets dropdown

        $assets = $this->get_assets();

        //prepare kod units dropdown

        $kod_units = $this->get_kod_unit();

        $complain_actions = $this->get_complain_actions($id);

        return view('complains/technical_action',compact('complain','complain_statuses','complain_actions','complain_categories','complain_sources','locations','branches','assets','kod_units'));
    }

    /*
     * Tindakan helpdesk update action
     * */

    public function update_technical_action(Request $request, $id)
    {
        $complain = Complain::find($id);

        $complain_status_id = $request->complain_status_id;

        $complain->complain_status_id = $complain_status_id;
        $complain->action_comment = $request->action_comment;
        $complain->delay_reason = $request->delay_reason;

        if($request->complain_status_id=='3')
        {
            $complain->action_date = Carbon::now();

        }

        $complain->save();

        //technical action event

        Event::fire(new ComplainTechnicalAction($complain));

        //simpan action log if SAHKAN (P)

        if($request->complain_status_id=='3')
        {

            //insert into complain action as logs

            $complain_action = new ComplainAction;
            $complain_action->complain_id = $id;

            $complain_action->complain_status_id = $complain_status_id;

            $complain_action->action_by = $this->user_id;

            $complain_action->action_comment = $request->action_comment;

            $complain_action->delay_reason = $request->delay_reason;

            $complain_action->save();

        }

        if($request->complain_status_id=='2')
        {
            Flash::success('Aduan berjaya dikemaskini');
        }
        else if($request->complain_status_id=='3')
        {
            Flash::success('Aduan berjaya di hantar untuk pengesahan pengadu');
        }

        return back();
    }

    public function assign()
    {

        $complains = Complain::where('unit_id',$this->unit_id)->
        where('complain_status_id',7)->
        orderBy('complain_id','desc')->
        paginate(20);

        return view('complains/assign_index',compact('complains'));
    }

    public function assign_staff($id)
    {
        //paparkan maklumat complain

        $complain = Complain::find($id);

        //paparkan juga complain action history

        $complain_actions = $this->get_complain_actions($id);

        //dapatkan senarai staff dalam unit yang sama

        $unit_staff_list = User::where('kod_id',$this->unit_id)->
        where('id','!=',$this->user_id)->
        lists('name','id')
        ;

        $unit_staff_list = array(''=>'Pilih Staff') + $unit_staff_list->all();

        //load the view and pass the variable using compact

        return view('complains/assign_staff',compact('complain','complain_actions','unit_staff_list'));
    }

    /*
     * Submit form ASSIGN STAFF
     * */

    public function update_assign_staff(Request $request,$id)
    {
        $complain = Complain::find($id);
        $complain->action_emp_id = $request->action_emp_id;
        $complain->assign_date = Carbon::now();
        $complain->complain_status_id = 2;
        $complain->save();

        //assign staff event

        Event::fire(new ComplainAssignStaff($complain));

        //insert into complain action as logs

        $complain_action = new ComplainAction;

        $complain_action->complain_id = $id;

        $complain_action->complain_status_id = 7;

        $complain_action->action_by = $this->user_id;

        $complain_action->save();

        Flash::success('Aduan telah diagihkan kepada staff');

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

        $complain_categories = ComplainCategory::select('description', DB::raw('CONCAT(category_id, "-", kod_unit) AS category_value'))->lists('description','category_value');

        $complain_categories = array(''=>'Pilih Kategori') + $complain_categories->all();

        return $complain_categories;
    }

    function get_complain_sources()
    {
        $complain_sources = ComplainSource::lists('description','source_id');

        $complain_sources = array(''=>'Pilih Kaedah') + $complain_sources->all();

        return $complain_sources;
    }

    function get_locations($filter=array())
    {

        //check for edit filter by branch_id in array

        if (isset($filter['branch_id']) && !empty($filter['branch_id']))
        {
            $branch_id = $filter['branch_id'];
        }

        //check for AJAX request filter by branch_id

        if ($this->request->has('branch_id')) {
            $branch_id = $this->request->input('branch_id');
        }

        if (!empty($branch_id))
        {
            $locations = AssetsLocation::where('branch_id',$branch_id)->lists('location_description','location_id');
        }
        else
        {
            $locations = AssetsLocation::lists('location_description','location_id');
        }

        $locations = array(''=>'Pilih Lokasi') + $locations->all();

        return $locations;
    }

    function get_assets()
    {
        $lokasi_id = $this->request->lokasi_id;

        if (!empty($lokasi_id))
        {
            $assets = Asset::select('id', DB::raw('CONCAT(id, " - ", butiran) AS butiran_aset'))->
                        where('lokasi_id',$lokasi_id)->lists('butiran_aset','id');
        }
        else
        {
            $assets = Asset::select('id', DB::raw('CONCAT(id, " - ", butiran) AS butiran_aset'))->
                        lists('butiran_aset','id');

        }

        $assets = array(''=>'Pilih Aset') + $assets->all();

        return $assets;
    }

    function get_branches()
    {
        $branches = Branch::lists('branch_description','id');

        $branches = array(''=>'Pilih Cawangan') + $branches->all();

        return $branches;
    }

    public function get_kod_unit($filter=array())
    {
        $kod_units = KodUnit::lists('butiran','kod_id');

        return $kod_units;
    }

}
