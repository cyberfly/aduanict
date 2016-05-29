@extends('layouts.app')

@section('heading', 'Edit Role')

@section('content')
{!! Form::open(['route' => ['admin.roles.update',$role->id],'method'=>'put']) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : false }}">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $role->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : false }}">
        {!! Form::label('display_name', 'Display Name') !!}
        {!! Form::text('display_name', $role->display_name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group {{ $errors->has('permissions') ? 'has-error' : false }}">
        {!! Form::label('permissions', 'Permissions') !!}

        <select name="permissions[]" id="permissions" multiple class="form-control" size="<?php echo $permissions->count() ?>">
          @foreach($permissions as $index => $relation)
            <option value="{{ $index }}" {{ ((in_array($index, old('permissions', []))) || ( ! Session::has('errors') && $role->perms->contains('id', $index))) ? 'selected' : '' }}>{{ $relation }}</option>
          @endforeach
        </select>

    </div>


    <button type="submit" id="update" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('admin/general.update') }}</button>

    <a class="btn btn-labeled btn-default" href="{{ route('admin.roles.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ trans('admin/general.cancel') }}</a>

{!! Form::close() !!}
@endsection
