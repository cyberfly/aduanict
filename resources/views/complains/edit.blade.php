@extends('layouts.app')


@section('content')

    @include('layouts.alert_message')

    @include('partials.complain_notification')

    {{--include edit form if --}}

    @if($complain->complain_status_id==1)

    @include('complains.partials.edit_form')

    @else

        {{--show verify form to pengadu/bagi pihak if status SAHKAN (P)--}}

        @if($complain->complain_status_id==3 && ($complain->user_id==Auth::user()->id || $complain->user_emp_id==Auth::user()->id))

            @include('complains.partials.verify_form')

        @endif

        {{--show the complain info--}}
        @include('complains.partials.complain_info')

    @endif

    {{--latest helpdesk action --}}

    @include('complains.partials.complain_action_log')

@endsection

@section('script')

    <script type="text/javascript">

        $( document ).ready(function() {

            //bila pengadu klik butang Selesai
            $("#submit_finish").click(function() {

                swal({
                    title: "And pasti untuk selesaikan aduan ini?",
                    text: "Tindakan ini tidak dapat di batalkan kembali",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, saya pasti!",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false
                }, function(){
                    var submit_type = 'finish';
                    submit_form(submit_type);
                }
                );

            });

            //bila pengadu klik butang Tidak Selesai

            $("#submit_reject").click(function() {

                swal({
                    title: "And pasti untuk tidak selesaikan aduan ini?",
                    text: "Tindakan ini tidak dapat di batalkan kembali",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, saya pasti!",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false
                }, function(){
                    var submit_type = 'reject';
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

    @include('complains.partials.form_script')
@endsection
