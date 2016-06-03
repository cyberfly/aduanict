@extends('layouts.app')


@section('content')

    @include('layouts.alert_message')

    @include('partials.complain_notification')

    {{--include edit form if --}}

    @if($complain->complain_status_id==1)

    @include('complains.partials.edit_form')

    @else

    @include('complains.partials.verify_form')

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

            $("#submit_reject").click(function() {
                var submit_type = 'reject';
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
