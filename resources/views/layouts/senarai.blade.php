@extends('layouts.app)
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Agihan Tugas</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-info" role="alert">
                Sila pilih kakitangan yang akan dipertanggungjawabkan untuk melaksanakan tugasan ini.
            </div>
            <div class="row">
                <div class="col-sm-10 col-xs-2">
                    <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        10 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">9</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">7</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 col-xs-10">
                    <input type="text" class="form-control" placeholder="Cari..." aria-describedby="basic-addon1">
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Nama Kakitangan</th>
                        <th>Lokasi</th>
                        <th>Tarikh</th>
                        <th>Status</th>
                        <th></th>

                    </tr>
                    <tr>
                        <td>Mohd Zulkifli Deraman</td>
                        <td>SHAMELIN</td>
                        <td>12/03/2016 9:30:05 am</td>
                        <td><span class="label label-primary labelcustomize ">Baru</span></td>
                        <td class="text-right"><a href="tindakan.html" type="submit" class="btn btn-success">AGIH TUGAS</a></td>
                    </tr>
                    <tr>
                        <td>Siti Nordiana</td>
                        <td>PRESINT 15</td>
                        <td>12/03/2016 9:30:05 am</td>
                        <td><span class="label label-primary labelcustomize ">Baru</span></td>
                        <td class="text-right"><a href="tindakan.html" type="submit" class="btn btn-success">AGIH TUGAS</a></td>
                    </tr>
                    <tr>
                        <td>Ustaz Don Daniyal</td>
                        <td>SHAMELIN</td>
                        <td>12/03/2016 9:30:05 am</td>
                        <td><span class="label label-primary labelcustomize ">Baru</span></td>
                        <td class="text-right"><a href="tindakan.html" type="submit" class="btn btn-success">AGIH TUGAS</a></td>
                    </tr>
                </table>
                <nav class="navbar-form navbar-right">
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    @endsection
