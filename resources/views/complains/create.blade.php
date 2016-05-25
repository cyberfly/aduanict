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

                            {!! Form::select('login_daftar', $users, '', ['class' => 'form-control']); !!}

                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bagiPihak">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-12 control-label">Kategori</label>
                    <div class="col-sm-3 col-xs-10">
                        <select class="form-control input-sm">
                            <option>Zakat2u</option>
                            <option>Call Center</option>
                            <option>Aplikasi</option>
                        </select>
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
                        <select class="form-control input-sm">
                            <option>Telefon</option>
                            <option>Email</option>
                            <option>Mesej</option>
                        </select>
                    </div>
                </div>
                <div class="form-group  {{ $errors->has('aduan') ? 'has-error' : false }} ">
                    <label class="col-sm-2 control-label">Aduan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="aduan" rows="3">{{ old('aduan') }}</textarea>
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
