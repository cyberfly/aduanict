@extends('admin.app')

@section('content')
    <h3 class="">Tambah Kebenaran</h3>
{!! Form::open(['route' => 'admin.permissions.store']) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : false }}">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : false }}">
        {!! Form::label('display_name', 'Display Name') !!}
        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
    </div>

    <button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>Hantar</button>

    <a class="btn btn-labeled btn-default" href="{{ route('admin.permissions.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>Kembali</a>

{!! Form::close() !!}
@endsection
