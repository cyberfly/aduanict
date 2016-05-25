@extends('layouts.app')


@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Maklumat Akaun</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3  col-xs-10 control-label">Username </label>
                    <div class="col-sm-4 col-xs-12">
                        <p class="form-control-static">Hafizullah</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class=" col-sm-3  col-xs-10 control-label">Kata Laluan Lama</label>
                    <div class="col-sm-4 col-xs-12 ">
                        <input type="username" class="form-control" id="username" placeholder="Masukkan Kata Laluan Lama">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class=" col-sm-3  col-xs-10 control-label">Kata Laluan Baru</label>
                    <div class="col-sm-4 col-xs-12 ">
                        <input type="username" class="form-control" id="username"  placeholder="Masukkan Kata Laluan Baru">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class=" col-sm-3 col-xs-10 control-label">Pengesahan Kata Laluan</label>
                    <div class="col-sm-4 col-xs-12 ">
                        <input type="username" class="form-control" id="username"  placeholder="Pengesahan Kata Laluan Baru">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
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