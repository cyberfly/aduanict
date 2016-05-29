@extends('layouts.app')

@section('heading', 'Edit Permission')

@section('content')
{!! Form::open(['route' => ['admin.permissions.update',$permission->id],'method'=>'put']) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : false }}">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $permission->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : false }}">
        {!! Form::label('display_name', 'Display Name') !!}
        {!! Form::text('display_name', $permission->display_name, ['class' => 'form-control']) !!}
    </div>

    <button type="submit" id="update" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('admin/general.update') }}</button>

    <a class="btn btn-labeled btn-default" href="{{ route('admin.permissions.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ trans('admin/general.cancel') }}</a>

{!! Form::close() !!}
@endsection
