@extends('layouts.app')

@section('heading', 'Create Permission')

@section('content')
{!! Form::open(['route' => 'admin.permissions.store']) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : false }}">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : false }}">
        {!! Form::label('display_name', 'Display Name') !!}
        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
    </div>

    <button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('admin/general.create') }}</button>

    <a class="btn btn-labeled btn-default" href="{{ route('admin.permissions.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ trans('admin/general.cancel') }}</a>

{!! Form::close() !!}
@endsection
