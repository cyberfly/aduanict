@extends('layouts.app')


@section('content')

    @include('layouts.alert_message')
    @include('partials.complain_notification')

    {{--show agih form if status is AGIHAN--}}

    @if($complain->complain_status_id==7)

        {!! Form::open(array('route' => ['complain.update_assign_staff',$complain->complain_id],'method'=>'put','class'=>"form-horizontal", 'id'=>'form1')) !!}

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Tindakan ICT Helpdeck</h3>
            </div>

            @if($complain->complain_status_id==4)

                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tarikh </label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo date('d/m/Y'); ?></p>
                        </div>
                        <label class="col-sm-2 control-label">Masa </label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo date('H:i:s'); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-xs-12 control-label">Status</label>
                        <div class="col-sm-3 col-xs-10">

                            Sahkan H
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">

                            <input type="hidden" name="submit_type" id="submit_type" value="{{ old('submit_type') }}">
                            <button type="button" id="submit_finish" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Tutup Aduan</button>

                        </div>
                    </div>

                </div>

            @else

                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tarikh </label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo date('d/m/Y'); ?></p>
                        </div>
                        <label class="col-sm-2 control-label">Masa </label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo date('H:i:s'); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Senarai Staff </label>
                        <div class="col-sm-6">

                            {!! Form::select('action_emp_id', $unit_staff_list, '', ['class' => 'form-control chosen']); !!}

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">

                            <input type="hidden" name="submit_type" id="submit_type" value="{{ old('submit_type') }}">

                            <button type="button" id="submit_assign" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Agih</button>
                            <a href="{{ route('complain.assign') }}" class="btn btn-default">Kembali</a>

                        </div>
                    </div>

                </div>

            @endif



        </div>

        {!! Form::close() !!}


    @else

        {{--show the complain info--}}
        @include('complains.partials.complain_info')

    @endif

    <!--end-->


    {{--latest helpdesk action --}}

    @include('complains.partials.complain_action_log')

@endsection

@section('script')

    <script type="text/javascript">

        $( document ).ready(function() {

            $("#submit_assign").click(function() {

                swal({
                    title: "And pasti untuk agih kepada staff ini?",
                    text: "Tindakan ini tidak dapat di batalkan kembali",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, saya pasti!",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false
                    }, function(){
                        var submit_type = 'assign';
                        submit_form(submit_type);
                    }
                );

            });

            function submit_form(submit_type)
            {
                //letak value for hidden field

                $('#submit_type').val(submit_type);

                //suruh javascript submit form bukannya button submit

                $('#form1').submit();
            }

        });

    </script>

@endsection
