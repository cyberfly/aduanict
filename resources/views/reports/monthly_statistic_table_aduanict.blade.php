@extends('layouts.app')

@section('filter')

    <div class="panel panel-info">
        <div class="panel-heading">Carian</div>
        <div class="panel-body">

            {!! Form::open(array('route' => 'report.monthly_statistic_table_aduanict', 'method'=>'GET', 'id'=>'form1')) !!}

            <div class="row">

                <div class="col-md-3">

                    {!! Form::select('branch_id', $branches, Request::get('branch_id'), ['class' => 'form-control chosen', 'id'=>'branch_id']); !!}

                </div>

                <div class="col-md-2">

                    {!! Form::text('start_date',Request::get('start_date'),array('class'=>'form-control datepicker','placeholder'=>'Start Date')) !!}

                </div>

                <div class="col-md-2">
                    {!! Form::text('end_date',Request::get('end_date'),array('class'=>'form-control datepicker','placeholder'=>'End Date')) !!}

                </div>

                <div class="col-md-4">
                    <input type="hidden" name="submit_type" id="submit_type" value="search">
                    <input type="button" id="search" class="btn btn-primary" value="Filter Rekod">
                    <input type="button" id="download_pdf" class="btn btn-default" value="Download PDF">
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

            <table class="table table-bordered table-striped table-hover">
                <tr class="warning">
                    <th>Kategori</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mac</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Ogos</th>
                    <th>Sept</th>
                    <th>Okt</th>
                    <th>Nov</th>
                    <th>Dis</th>
                </tr>
                @foreach($complains_statistics_row as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>

                        @foreach($value as $month_total)

                        <td>{{ $month_total }}</td>

                        @endforeach

                    </tr>
                @endforeach
                <tfoot>
                <tr class="info">
                    <td>Jumlah</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">

        $( document ).ready(function() {

            $("#search").click(function() {
                var submit_type = 'search';
                submit_form(submit_type);
            });

            $("#download_pdf").click(function() {
                var submit_type = 'download_pdf';
                submit_form(submit_type);
            });

            function submit_form(submit_type) {
                //set hidden field submit type
                $("#submit_type").val(submit_type);
                //submit form
                $("#form1").submit();
            }


        });

    </script>

@endsection

