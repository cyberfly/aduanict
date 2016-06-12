@extends('layouts.app')

@section('content')

    @include('layouts.alert_message')

    @include('partials.complain_notification')

    {{--show the complain info--}}
    @include('complains.partials.complain_info')

    {{--latest helpdesk action --}}

    @include('complains.partials.complain_action_log')

@endsection

