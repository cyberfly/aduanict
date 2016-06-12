<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetsLocation;
use App\Branch;
use App\ComplainCategory;
use App\ComplainSource;
use App\ComplainStatus;
use App\KodUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class BaseController extends Controller
{
    public function __construct(Request $request)
    {

    }

    /*
     * get locations by filter array or ajax request
     * */

    function get_locations($filter=array())
    {
        $branch_id = 0;

        //check for edit filter by branch_id in array

        if (isset($filter['branch_id']) && !empty($filter['branch_id']))
        {
            $branch_id = $filter['branch_id'];
        }

        //check for AJAX request filter by branch_id

        if ($this->request->has('branch_id')) {
            $branch_id = $this->request->input('branch_id');
        }

        //if validation error, get current branch id

        if (empty($branch_id))
        {
            $validation_branch_id = $this->request->old('branch_id');
            $branch_id = $validation_branch_id;
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

    public function get_complain_statuses()
    {
        $complain_statuses = ComplainStatus::lists('description','status_id');

        $complain_statuses = [''=>'Pilih Status'] + $complain_statuses->all();
        return $complain_statuses;
    }

    function get_assets($filter=array())
    {
        //filter by ajax request

        $lokasi_id = $this->request->lokasi_id;

        //or filter by array from other function

        if (isset($filter['lokasi_id']) && !empty($filter['lokasi_id']))
        {
            $lokasi_id = $filter['lokasi_id'];
        }

        //or filter if validation error, get current branch id

        if (empty($lokasi_id))
        {
            $validation_lokasi_id = $this->request->old('lokasi_id');
            $lokasi_id = $validation_lokasi_id;
        }

        if (!empty($lokasi_id))
        {
            $assets = Asset::select('id', DB::raw('CONCAT(id, " - ", butiran) AS butiran_aset'))->
            where('lokasi_id',$lokasi_id)->lists('butiran_aset','id');

            $assets = array(''=>'Pilih Aset') + $assets->all();
        }
        else
        {
            $assets = array(''=>'Pilih Aset');
        }

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

    function prepare_branch_location_assets($complain,$method='edit')
    {

        if (!in_array($complain->complain_category_id, $this->exclude_array))
        {
            //prepare locations dropdown

            $complain_branch_id = $complain->assets_location->branch_id;

            $location_filter = array('branch_id'=>$complain_branch_id);

            $locations = $this->get_locations($location_filter);

            //prepare branch dropdown

            $branches = $this->get_branches();

            //prepare assets dropdown

            $complain_lokasi_id = $complain->lokasi_id;

            $assets_filter = ['lokasi_id'=>$complain_lokasi_id];

            $assets = $this->get_assets($assets_filter);

            $hide_branches_assets_locations = 'N';
        }
        else{

            if ($method=='action')
            {
                $locations = $this->get_locations();
                $branches = $this->get_branches();
                $assets = $this->get_assets();
                $hide_branches_assets_locations = 'N';
            }
            else
            {
                $branches = [];
                $locations = [];
                $assets = [];
                $hide_branches_assets_locations = 'Y';
            }

        }

        return ['branches'=>$branches,
            'locations'=>$locations,
            'assets'=>$assets,
            'hide_branches_assets_locations'=>$hide_branches_assets_locations,
        ];
    }

    /*
     * Convert 12/03/2016 (user date picker) to 2016-03-12 (database date format)
     * */

    function format_date($date)
    {
        $exp_date = explode('/',$date);
        $get_year = $exp_date[2];
        $get_month = $exp_date[1];
        $get_day = $exp_date[0];

        $formatted_date = Carbon::createFromDate($get_year, $get_month, $get_day)->format('Y-m-d');

        return $formatted_date;
    }
}
