@extends('layouts.app')

@section('filter')

    <div class="panel panel-info">
        <div class="panel-heading">Carian</div>
        <div class="panel-body">

            {!! Form::open(array('route' => 'complain.index', 'method'=>'GET')) !!}

            <div class="row">

                <div class="col-md-3">

                    {!! Form::select('complain_status_id', $complain_statuses, Request::get('complain_status_id'), ['class' => 'form-control', 'id'=>'complain_status_id']); !!}

                </div>

                <div class="col-md-3">

                    {!! Form::text('search_anything',Request::get('search_anything'),array('class'=>'form-control','placeholder'=>'Carian ...')) !!}

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

    @include('layouts.alert_message')


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Senarai Aduan</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-10 col-xs-2">
                    <a href="{{ route('complain.create') }}" class="btn btn-warning">Tambah Aduan</a>
                    <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        10 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">9</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">7</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Pengadu</th>
                    <th>No Aduan</th>
                    <th>Aduan</th>
                    <th>Tarikh</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                    <th></th>

                </tr>

                @foreach($complains as $complain)

                <tr>
                    <td>
                        {{ $complain->user->full_name or $complain->user_id }}
                    </td>
                    <td>{{ $complain->complain_id }}</td>
                    <td>{{ str_limit($complain->complain_description,20) }}</td>
                    <td>{{ $complain->malaysia_date }}</td>
                    <td>

                        {!! CustomHelper::format_complain_status($complain->complain_status_id) !!}

                    </td>
                    <td>{{ $complain->assign_user->name or '-' }}</td>
                    <td>

                        {!! Form::open(array('route' => ['complain.destroy',$complain->complain_id],'method'=>'delete','class'=>"form-horizontal")) !!}

                        {!! CustomHelper::format_action_button($complain) !!}

                        {!! Form::close() !!}

                    </td>
                </tr>

                @endforeach

            </table>
            <nav class="navbar-form navbar-right">

                {{ $complains->appends(Request::except('page'))->links() }}

            </nav>
        </div>
        </div>
    </div>

@endsection
