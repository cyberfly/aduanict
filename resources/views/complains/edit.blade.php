@extends('layouts.app')


@section('content')

    @include('layouts.alert_message')

    {!! Form::open(array('route' => ['complain.update',$complain->complain_id],'method'=>'put','class'=>"form-horizontal")) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Maklumat Aduan</h3>
        </div>
        <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Tarikh </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">18/05/2016</p>
                    </div>
                    <label class="col-sm-2 control-label">Masa </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">9:05:15:16 am</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Pengadu </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">{{ $complain->EMP_ID_ADUAN }}</p>
                    </div>
                    <label class="col-sm-2 control-label">No. Pekerja </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">196</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Bagi Pihak</label>
                    <div class="col-sm-2">
                        <p class="form-control-static">- </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-2">
                        <p class="form-control-static">Perkakasan </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Aset</label>
                    <div class="col-sm-2">
                        <p class="form-control-static">Komputer 1 </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Kaedah</label>
                    <div class="col-sm-2">
                        <p class="form-control-static">Telefon </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Aduan</label>
                    <div class="col-sm-6">
                        <p class="form-control-static">{{ $complain->complain_description }}</p>
                    </div>
                </div>

        </div>
    </div>
    <!--end-->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Tindakan ICT Helpdeck</h3>
        </div>
        <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Tarikh </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">18/05/2016</p>
                    </div>
                    <label class="col-sm-2 control-label">Masa </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">9:05:15:16 am</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Bahagian/Unit </label>
                    <div class="col-sm-2">
                        <p class="form-control-static">Unit Perkakasan & Perisian</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-12 control-label">Status</label>
                    <div class="col-sm-3 col-xs-10">
                        <select class="form-control input-sm">
                            <option selected>Baru</option>
                            <option>Tindakan</option>
                            <option>Selesai</option>
                        </select>
                    </div>
                    <label class="col-sm-1 col-xs-1 control-label">
                        <span class="pull-left symbol"> * </span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-12 control-label">Tindakan</label>
                    <div class="col-sm-6 col-xs-10">
                        <textarea class="form-control" rows="3" name="butiran_aduan"></textarea>
                    </div>
                    <label class="col-sm-1 col-xs-1 control-label">
                        <span class="pull-left symbol"> * </span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-12 control-label">Sebab Lewat</label>
                    <div class="col-sm-6 col-xs-10">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" class="btn btn-primary">Hantar</button>
                        <a href="{{ route('complain.index') }}" class="btn btn-default">Kembali</a>

                    </div>
                </div>

        </div>
    </div>

    {!! Form::close() !!}

@endsection
