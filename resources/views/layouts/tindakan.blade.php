@extends('layouts.app)
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Maklumat Aduan</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
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
                        <p class="form-control-static">Mohd Hafizullah</p>
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
                        <p class="form-control-static">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec
                            ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare
                            vel eu leo. Nulla vitae elit libero, a pharetra augue.</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end-->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Tindakan Teknikal</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
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
                    <label class="col-sm-2 col-xs-12 control-label">Tindakan</label>
                    <div class="col-sm-6 col-xs-10">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <label class="col-sm-1 col-xs-1 control-label">
                        <span class="pull-left symbol"> * </span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-12 control-label">Dokumen</label>
                    <div class="col-sm-6 col-xs-10">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-xs-10 control-label">Sebab Lewat</label>
                    <div class="col-sm-6 col-xs-10">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="detailtindakan.html" type="submit" class="btn btn-primary">Hantar</a>
                        <button type="submit" class="btn btn-default">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
