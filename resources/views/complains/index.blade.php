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

                        @if($complain->user)

                            {{ $complain->user->name }}

                        @else

                            {{ $complain->user_id }}

                        @endif

                    </td>
                    <td>{{ $complain->complain_id }}</td>
                    <td>{{ str_limit($complain->complain_description,20) }}</td>
                    <td>{{ $complain->created_at }}</td>
                    <td>
                        <?php

                        $status = '';

                        if($complain->complain_status_id==1){
                            $status = '<span class="label label-primary">Baru</span>';
                        }
                        else if($complain->complain_status_id==3)
                        {
                            $status = '<span class="label label-warning">Sahkan (P)</span>';
                        }
                        else if($complain->complain_status_id==2)
                        {
                            $status = '<span class="label label-warning">Tindakan</span>';
                        }
                        else if($complain->complain_status_id==4)
                        {
                            $status = '<span class="label label-success">Sahkan (H)</span>';
                        }
                        else if($complain->complain_status_id==5)
                        {
                            $status = '<span class="label label-success">Selesai</span>';
                        }
                        else if($complain->complain_status_id==7)
                        {
                            $status = '<span class="label label-warning">Agihan</span>';
                        }

                        ?>

                        {!! $status  !!}
                    </td>
                    <td>{{ $complain->assign_user->name or '-' }}</td>
                    <td>

                        {!! Form::open(array('route' => ['complain.destroy',$complain->complain_id],'method'=>'delete','class'=>"form-horizontal")) !!}

                        {{--bila status BARU--}}

                        @if($complain->complain_status_id==1)

                            {{--if helpdesk action complain--}}

                            @if(Entrust::can('action_complain') && Entrust::hasRole('ict_helpdesk'))

                                <a href="{{ route('complain.action', $complain->complain_id) }}" class="btn btn-default"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Kemaskini</a>

                            @elseif(Entrust::can('edit_complain'))

                                <a href="{{ route('complain.edit', $complain->complain_id) }}" class="btn btn-default"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Kemaskini</a>

                            @else

                                <a href="{{ route('complain.show', $complain->complain_id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>

                            @endif

                            @if(Entrust::can('delete_complain'))

                                <button type="button" class="btn btn-danger" data-destroy ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button>

                            @endif

                        {{--bila status TINDAKAN--}}
                        @elseif($complain->complain_status_id==2)

                            @if(Entrust::can('technical_action_complain') && $complain->user_id!=Auth::user()->id && $complain->user_emp_id!=Auth::user()->id && $complain->action_emp_id==Auth::user()->id)

                                <a href="{{ route('complain.technical_action', $complain->complain_id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Tindakan</a>

                            @elseif(Entrust::can('action_complain') && $complain->action_emp_id==Auth::user()->id)

                                <a href="{{ route('complain.action', $complain->complain_id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Tindakan</a>

                             @else

                                <a href="{{ route('complain.show', $complain->complain_id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>

                            @endif

                        {{--bila status SAHKAN P--}}
                        @elseif($complain->complain_status_id==3)

                            @if(Entrust::can('verify_complain_action') && $complain->complain_status_id==3 && $complain->user_id==Auth::user()->id)

                                <a href="{{ route('complain.edit', $complain->complain_id) }}" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Pengesahan</a>

                            @else

                                <a href="{{ route('complain.show', $complain->complain_id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>

                            @endif

                        @elseif($complain->complain_status_id==4)

                            @if(Entrust::can('action_complain') && Entrust::hasRole('ict_helpdesk'))

                                <a href="{{ route('complain.action', $complain->complain_id) }}" class="btn btn-success"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Pengesahan H</a>
                            @else

                                <a href="{{ route('complain.show', $complain->complain_id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>

                            @endif

                        @elseif($complain->complain_status_id==5)

                            <a href="{{ route('complain.show', $complain->complain_id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>

                        @elseif($complain->complain_status_id==7)

                            @if(Entrust::can('assign_complain'))

                                <a href="{{ route('complain.assign_staff', $complain->complain_id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Agihan</a>
                            @else

                                <a href="{{ route('complain.show', $complain->complain_id) }}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Papar</a>

                            @endif

                        @else

                            <a href="{{ route('complain.edit', $complain->complain_id) }}" class="btn btn-default"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Kemaskini</a>

                        @endif



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
