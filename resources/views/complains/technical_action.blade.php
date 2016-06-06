@extends('layouts.app')


@section('content')

    @include('layouts.alert_message')
    @include('partials.complain_notification')


    {{--include edit form if complain is still new--}}

    @if($complain->complain_status_id==2)

        @include('complains.partials.edit_form', ['exclude_category'=>'Y'])

    @else

        {{--show the complain info--}}
        @include('complains.partials.complain_info')

    @endif

    <!--end-->

    {{--show TINDAKAN FORM when status is TINDAKAN --}}

    @if($complain->complain_status_id==2)

    {!! Form::open(array('route' => ['complain.update_technical_action',$complain->complain_id],'method'=>'put','class'=>"form-horizontal", 'id'=>'form1')) !!}

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Tindakan ICT Helpdeck</h3>
        </div>

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
                <label class="col-sm-2 control-label">Bahagian/Unit </label>
                <div class="col-sm-6">


                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-xs-12 control-label">Status <span class="symbol"> * </span></label>
                <div class="col-sm-3 col-xs-10">

                    {!! Form::select('complain_status_id', $complain_statuses, $complain->complain_status_id, ['class' => 'form-control chosen']); !!}

                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-xs-12 control-label">Tindakan <span class="symbol"> * </span></label>
                <div class="col-sm-6 col-xs-10">
                    <textarea class="form-control" rows="3" name="action_comment">{{ old('action_comment',$complain->action_comment) }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-xs-12 control-label">Sebab Lewat</label>
                <div class="col-sm-6 col-xs-10">
                    <textarea class="form-control" rows="3" name="delay_reason">{{ old('delay_reason',$complain->delay_reason) }}</textarea>
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

    @endif

    {{--latest helpdesk action --}}

    @include('complains.partials.complain_action_log')

@endsection

@section('script')

    <script type="text/javascript">

        $( document ).ready(function() {

            $("#submit_finish").click(function() {
                var submit_type = 'finish';
                submit_form(submit_type);
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
