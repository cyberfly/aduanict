@extends('layouts.app')


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
                <div class="col-sm-2 col-xs-10">
                    <input type="text" class="form-control" placeholder="Cari..." aria-describedby="basic-addon1">
                </div>
            </div>
            <hr>
            <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Pengadu</th>
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
                    <td>{{ str_limit($complain->complain_description,20) }}</td>
                    <td>{{ $complain->created_at }}</td>
                    <td><span class="label label-primary">Baru</span></td>
                    <td>Pok Lee</td>
                    <td>

                        {!! Form::open(array('route' => ['complain.destroy',$complain->complain_id],'method'=>'delete','class'=>"form-horizontal")) !!}

                        <a href="{{ route('complain.edit', $complain->complain_id) }}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Kemaskini</a>

                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button>

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
