@extends('layouts.app')


@section('content')

    @include('layouts.alert_message')


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Senarai Agihan Aduan</h3>
        </div>
        <div class="panel-body">

            <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
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
                        else if($complain->complain_status_id==3)
                        {
                            $status = '<span class="label label-success">Tindakan</span>';
                        }
                        else if($complain->complain_status_id==4)
                        {
                            $status = '<span class="label label-success">Sahkan (H)</span>';
                        }
                        else if($complain->complain_status_id==5)
                        {
                            $status = '<span class="label label-success">Selesai</span>';
                        }


                        ?>

                        {!! $status  !!}
                    </td>
                    <td>Pok Lee</td>
                    <td>

                        @if(Entrust::can('assign_complain'))

                            <a href="{{ route('complain.assign_staff', $complain->complain_id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Agihan</a>

                        @endif

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
