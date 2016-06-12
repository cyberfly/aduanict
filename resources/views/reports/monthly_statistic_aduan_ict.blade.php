@extends('layouts.app')

@section('filter')

    <div class="panel panel-info">
        <div class="panel-heading">Carian</div>
        <div class="panel-body">

            {!! Form::open(array('route' => 'report.monthly_statistic_aduan_ict', 'method'=>'GET')) !!}

            <div class="row">

                <div class="col-md-3">

                    {!! Form::select('complain_category_id', $complain_categories, Request::get('complain_category_id'), ['class' => 'form-control chosen', 'id'=>'complain_category_id']); !!}

                </div>

                <div class="col-md-3">

                    {!! Form::select('branch_id', $branches, Request::get('branch_id'), ['class' => 'form-control chosen', 'id'=>'branch_id']); !!}

                </div>

                <div class="col-md-2">

                    {!! Form::text('start_date',Request::get('start_date'),array('class'=>'form-control datepicker','placeholder'=>'Start Date')) !!}

                </div>

                <div class="col-md-2">
                    {!! Form::text('end_date',Request::get('end_date'),array('class'=>'form-control datepicker','placeholder'=>'End Date')) !!}

                </div>

                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary" value="Filter Rekod">
                </div>

            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Monthly Statistic Report</div>
        <div class="panel-body">

            <canvas id="monthly_statistic_aduanict" width="400" height="200"></canvas>

        </div>
    </div>

@endsection

@section('script')

    <script>
        var ctx = document.getElementById("monthly_statistic_aduanict");

        var chart_data = {
            labels: {!! $month_name !!},
            datasets: [
                {
                    label: "Monthly Statistic AduanICT for  {!! $start_date !!} to  {!! $end_date !!}"  ,
                    backgroundColor: "rgba(255,99,132,0.2)",
                    borderColor: "rgba(255,99,132,1)",
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(255,99,132,0.4)",
                    hoverBorderColor: "rgba(255,99,132,1)",
                    data: {{ $monthly_total }},
                }
            ]
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chart_data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>

@endsection

