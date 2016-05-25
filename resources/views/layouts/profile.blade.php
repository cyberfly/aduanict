@extends('layouts.app')


@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Maklumat Peribadi</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 col-xs-2 control-label">Nama </label>
                    <div class="col-sm-5 ">
                        <input type="username" class="form-control" id="username" value="MOHD HAFIZULLAH BIN KAMARUDDIN">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class=" col-sm-2  col-xs-10 control-label">Alamat Hubungan</label>
                    <div class="col-sm-6 ">
                        <input type="username" class="form-control" id="username" value="NO.95, JALAN KESUMA 1/3">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class=" col-sm-2  col-xs-2 control-label"></label>
                    <div class="col-sm-6 col-xs-12 ">
                        <input type="username" class="form-control" id="username" value="TAMAN TASIK KESUMA">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class=" col-sm-2 col-xs-10 control-label">Poskod</label>
                    <div class="col-sm-2 col-xs-4 ">
                        <input type="username" class="form-control" id="username" value="16600">
                    </div>
                    <label for="username" class=" col-sm-2  col-xs-10 control-label">Bandar</label>
                    <div class="col-sm-4  col-xs-10 ">
                        <input type="username" class="form-control" id="username" value="BANDAR TASIK KESUMA">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class=" col-sm-2  col-xs-10 control-label">Negeri</label>
                    <div class="col-sm-5 col-xs-10">
                        <select class="form-control input-sm">
                            <option>SELANGOR</option>
                            <option>KEDAH</option>
                            <option>KELANTAN</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-2 col-xs-10 control-label">No.Telefon</label>
                    <div class="col-sm-2 col-xs-10 ">
                        <input type="username" class="form-control" id="username" value="0196745062">
                    </div>

                    <label for="username" class=" col-sm-2 col-xs-10 control-label">Emel</label>
                    <div class="col-sm-4 col-xs-10 ">
                        <input type="username" class="form-control" id="username" value="hafizullah@zakat.com.my">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="detail.html" type="submit" class="btn btn-primary">Kemaskini</a>
                        <button type="submit" class="btn btn-default">Kembali</button>
                    </div>
                </div>
            </form>
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
