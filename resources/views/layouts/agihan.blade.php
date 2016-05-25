@extends('layouts.app')


@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Maklumat Aduan</h3>
        </div>
        <div class="panel-body">
            <div class="form-horizontal">
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
            </div>
        </div>
    </div>
    <!--end-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tindakan ICT Helpdeck</h3>
        </div>
        <div class="panel-body">
            <div class="form-horizontal">
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
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-3">
                        <span class="label label-primary labelcustomize ">Baru</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tindakan</label>
                    <div class="col-sm-6">
                        <p class="form-control-static">Maecenas faucibus mollis interdum. Vestibulum id ligula porta felis euismod semper.
                            Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod.
                            Donec ullamcorper nulla non metus auctor fringilla. Vivamus sagittis lacus vel augue
                            laoreet rutrum faucibus dolor auctor.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sebab Lewat</label>
                    <div class="col-sm-6">
                        <p class="form-control-static text-muted">- tidak berkenaan -</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Agihan Tugas</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-info" role="alert">
                Sila pilih kakitangan yang akan dipertanggungjawabkan untuk melaksanakan tugasan ini.
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Nama Kakitangan</th>
                        <th>Lokasi</th>
                        <th>Tarikh</th>
                        <th></th>

                    </tr>
                    <tr>
                        <td>Mohd Zulkifli Deraman</td>
                        <td>SHAMELIN</td>
                        <td>12/03/2016 9:30:05 am</td>
                        <td class="text-right"><a href="senarai.html" type="submit" class="btn btn-success">AGIH TUGAS</a></td>
                    </tr>
                    <tr>
                        <td>Siti Nordiana</td>
                        <td>PRESINT 15</td>
                        <td>12/03/2016 9:30:05 am</td>
                        <td class="text-right"><a href="senarai.html" type="submit" class="btn btn-success">AGIH TUGAS</a></td>
                    </tr>
                    <tr>
                        <td>Ustaz Don Daniyal</td>
                        <td>SHAMELIN</td>
                        <td>12/03/2016 9:30:05 am</td>
                        <td class="text-right"><a href="senarai.html" type="submit" class="btn btn-success">AGIH TUGAS</a></td>
                    </tr>
                </table>
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

