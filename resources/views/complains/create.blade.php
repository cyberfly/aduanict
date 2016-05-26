@extends('layouts.app')


@section('content')

    @include('layouts.alert_message')


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Hantar Aduan</h3>
        </div>
        <div class="panel-body">

            {!! Form::open(array('route' => 'complain.store','class'=>"form-horizontal")) !!}

                <div class="form-group">
                    <label class="col-sm-2 col-xs-2 control-label">Tarikh </label>
                    <div class="col-sm-2 col-xs-10">
                        <p class="form-control-static">18/05/2016</p>
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-2 col-xs-2 control-label">Masa </label>
                    <div class="col-sm-2 col-xs-10">
                        <p class="form-control-static">9:05:15:16 am</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Pengadu </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">Mohd Hafizullah asfgg dasdasdadasdas dasdasdasdasdasdasdasdaadaad </p>
                    </div>
                    <label class="col-sm-2 control-label">No. Pekerja </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">196</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Bagi Pihak</label>
                    <div class="col-sm-6">
                        <div class="input-group">

                            {!! Form::select('user_emp_id', $users, '', ['class' => 'form-control chosen']); !!}

                        </div><!-- /input-group -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-12 control-label">Kategori</label>
                    <div class="col-sm-3 col-xs-10">

                        {!! Form::select('complain_category_id', $complain_categories, '', ['class' => 'form-control input-sm']); !!}


                    </div>
                    <label class="col-sm-1 col-xs-2 control-label">
                        <span class="pull-left symbol"> * </span>
                    </label>

                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Aset</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Aset">
                                    <span class="glyphicon glyphicon-search color" aria-hidden="true"></span>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Kaedah</label>
                    <div class="col-sm-3">

                        {!! Form::select('complain_source_id', $complain_sources, '', ['class' => 'form-control input-sm']); !!}

                    </div>
                </div>
                <div class="form-group  {{ $errors->has('complain_description') ? 'has-error' : false }} ">
                    <label class="col-sm-2 control-label">Aduan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="complain_description" rows="3">{{ old('complain_description') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Hantar</button>
                    <a href="{{ route('complain.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
        </div>
    </div>

@endsection

@section('modal')

<!-- Large modal -->
<div id="bagiPihak" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Bagi Pihak</h4>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        Firdaus
                    </a>
                    <a href="#" class="list-group-item">Syahril</a>
                    <a href="#" class="list-group-item">Ruzaini</a>
                    <a href="#" class="list-group-item">Rahmat</a>
                    <a href="#" class="list-group-item">Mohammad</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Large modal -->
<div id="Aset" class="modal fade bs-example-modal-lg" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel2">Senarai Aset</h4>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        Komputer Kaunter
                    </a>
                    <a href="#" class="list-group-item">Komputer 1</a>
                    <a href="#" class="list-group-item">Komputer 2</a>
                    <a href="#" class="list-group-item">Komputer 3</a>
                    <a href="#" class="list-group-item">Printer</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
