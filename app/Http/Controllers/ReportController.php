<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Complain;
use App\ComplainCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Debugbar;
use Illuminate\Support\Facades\View;
use PDF;

class ReportController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->middleware('ReportPermission');

        //guna ni for function that do not have Request

        $this->request = $request;

    }


    //paparkan bilangan aduan by date, for every month

    public function monthly_statistic_aduan_ict()
    {
        $get_startdate_enddate = $this->get_startdate_enddate();

        $start_date = $get_startdate_enddate['start_date'];
        $end_date = $get_startdate_enddate['end_date'];

        $complain_category_id = $this->request->complain_category_id;
        $branch_id = $this->request->branch_id;

        $complains = Complain::whereDate('created_at','>=',$start_date)
                    ->whereDate('created_at','<=',$end_date);

                    if(!empty($complain_category_id))
                    {
                        $exp_complain_category_id = explode('-', $complain_category_id);
                        $complain_category_id = $exp_complain_category_id[0];
                        $complains = $complains->where('complain_category_id',$complain_category_id);

                    }

                    if(!empty($branch_id))
                    {
//                        $complains = $complains->where('branch_id',$branch_id);
                    }

                    $complains = $complains->orderBy('created_at')
                    ->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->created_at)->format('M');
                    });

        $monthly_total = [];
        $month_name = [];

        foreach ($complains as $key => $complain) {
            $month_name[] = $key;
            $monthly_total[] = $complain->count();
        }

        $monthly_total = json_encode($monthly_total);
        $month_name = json_encode($month_name);

        /*$complains2 = Complain::where('created_at','>=',$start_date)->
                        where('created_at','<=',$end_date)->
                        groupBy(DB::raw('CAST(created_at AS DATE)'))->
                        get();*/

        $complain_categories = $this->get_complain_categories();

        $branches = $this->get_branches();

        return view('reports.monthly_statistic_aduan_ict',compact('monthly_total','month_name','start_date','end_date','complain_categories','branches'));

    }

    function monthly_statistic_table_aduanict()
    {
        $get_startdate_enddate = $this->get_startdate_enddate();

        $start_date = $get_startdate_enddate['start_date'];
        $end_date = $get_startdate_enddate['end_date'];

        $sql_queries = "SELECT complain_categories.description, month(complains.created_at) as MONTH, count(*) as jumlah 
                        FROM complains,complain_categories 
                        WHERE (complains.created_at BETWEEN '$start_date' AND '$end_date') 
                        and complain_categories.category_id=complains.complain_category_id 
                        GROUP BY complain_category_id, month(complains.created_at) 
                        order by complain_category_id, month(complains.created_at)";

        $complains = DB::select(DB::raw($sql_queries));

        $complains_statistics_row = [];
        $complains_statistics_col = [];

        foreach ($complains as $key => $row) {

            //if row dah ada, update column
            if (array_key_exists($row->description, $complains_statistics_row))
            {
                //dapatakn existing column from existing row
                //update column tersebut dengan new value

                $complains_statistics_col = $complains_statistics_row[$row->description];
                $complains_statistics_col = array_replace($complains_statistics_col, [$row->MONTH=>$row->jumlah]);
//              $complains_statistics_col = $complains_statistics_col + [$row->MONTH=>$row->jumlah];

                $complains_statistics_row[$row->description] = $complains_statistics_col;
            }
            else
            {
                //if row belum ada, create row and set default column value

                $default_value = [];
                for ($i=1;$i<=12;$i++)
                {
                    $default_value = $default_value + [$i=>0];
                }

                //create row dan replace new value from loop
                $complains_statistics_row[$row->description] = array_replace($default_value, [$row->MONTH=>$row->jumlah]);
//              $complains_statistics_row[$row->description] = $default_value + [$row->MONTH=>$row->jumlah];

            }

        }

//        dd($complains_statistics_row);

        //Debugbar::info($get_startdate_enddate);
        $complain_categories = $this->get_complain_categories();

        $branches = $this->get_branches();

        if ($this->request->submit_type!='download_pdf')
        {
            return view('reports.monthly_statistic_table_aduanict',compact('complains_statistics_row','complain_categories','branches'));
        }
        else
        {

            $view = View::make('reports.pdf.monthly_statistic_table_aduanict', compact('complains_statistics_row'));
            $contents = $view->render();

            $pdf = PDF::loadHTML($contents)->setPaper('a4', 'landscape')->setWarnings(false);

            return $pdf->download('monthly_statistic_report_aduanict.pdf');

        }

    }

    function get_startdate_enddate()
    {
        $start_date = $this->request->start_date;
        $end_date = $this->request->end_date;

        if (empty($start_date))
        {
            $current_year_start_date = date('Y').'-01-01';
            $start_date = $current_year_start_date;
        }
        else
        {
            //bila user search by start date, need to convert the format
            $exp_start_date = explode('/',$start_date);
            $get_year = $exp_start_date[2];
            $get_month = $exp_start_date[1];
            $get_day = $exp_start_date[0];

            $start_date = Carbon::createFromDate($get_year, $get_month, $get_day)->format('Y-m-d');

        }

        if (empty($end_date))
        {
            $current_year_end_date = date('Y').'-12-31';
            $end_date = $current_year_end_date;
        }
        else{
            //bila user search by end date, need to convert the format

            $exp_end_date = explode('/',$end_date);
            $get_year = $exp_end_date[2];
            $get_month = $exp_end_date[1];
            $get_day = $exp_end_date[0];

            $end_date = Carbon::createFromDate($get_year, $get_month, $get_day)->format('Y-m-d');
        }

        return ['start_date'=>$start_date,'end_date'=>$end_date];
    }

    function get_complain_categories()
    {
        //prepare complain category for dropdown

        $complain_categories = ComplainCategory::select('description', DB::raw('CONCAT(category_id, "-", kod_unit) AS category_value'))->lists('description','category_value');

        $complain_categories = array(''=>'Pilih Kategori') + $complain_categories->all();

        return $complain_categories;
    }

    function get_branches()
    {
        $branches = Branch::lists('branch_description','id');

        $branches = array(''=>'Pilih Cawangan') + $branches->all();

        return $branches;
    }

}
