@extends('admin.app')

@section('content')

    <h3 class="">Kemaskini Pengguna</h3>

    {!! Form::open(['route' => ['admin.users.update',$user->id],'method'=>'put']) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : false }}">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : false }}">
        {!! Form::label('email', 'Email address') !!}
        {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : false }}">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control','placeholder'=>'Password']) !!}
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : false }}">
        {!! Form::label('password_confirmation', 'Confirm Password') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>'Confirm Password']) !!}
    </div>


    <div class="form-group {{ $errors->has('roles') ? 'has-error' : false }}">
        {!! Form::label('roles', 'Roles') !!}

        <select name="roles[]" id="roles" multiple class="form-control" size="<?php echo $roles->count() ?>">
            @foreach($roles as $index => $role)
                <option value="{{ $index }}" {{ ((in_array($index, old('roles', []))) || ( ! Session::has('errors') && $user->roles->contains('id', $index))) ? 'selected' : '' }}>{{ $role }}</option>
            @endforeach
        </select>

    </div>


    <button type="submit" id="update" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>Hantar</button>

    <a class="btn btn-labeled btn-default" href="{{ route('admin.users.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>Kembali</a>

    {!! Form::close() !!}
@endsection