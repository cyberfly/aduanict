@extends('layouts.app')

@section('content_filter')

<div class="panel panel-info">
  <div class="panel-heading">Filter</div>
  <div class="panel-body">

        {!! Form::open(array('route' => 'admin.users.index', 'method'=>'GET')) !!}

            <div class="row">
              <div class="col-lg-4">
                {!! Form::text('name',Request::get('name'),array('class'=>'form-control','placeholder'=>'Enter Name')) !!}
              </div>
              <div class="col-lg-4">
                {!! Form::text('email',Request::get('email'),array('class'=>'form-control','placeholder'=>'Enter Email')) !!}
              </div>
              <div class="col-lg-4">
                {!! Form::submit(trans('admin/users.search-user'),array('class'=>'btn btn-primary')) !!}
              </div>
            </div>

        {!! Form::close() !!}


  </div>
</div>


@endsection

@section('heading', 'Users')

@section('content')
<div class="models-actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('admin.users.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('admin/users.create-user') }}</a>
</div>
<table class="table table-bordered table-striped table-hover">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Roles</th>
    <th>Actions</th>
  </tr>
  @foreach($users as $user)
    <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>

          @if($user->roles)

          @foreach($user->roles as $role)
              <code> {{ $role->display_name }} </code>
              <br>
          @endforeach

          @endif
      </td>
      <td class="col-xs-3">

        {!! Form::open(['data-remote','route' => ['admin.users.destroy',$user->id], 'method' => 'DELETE']) !!}

          @permission('edit_user')

          <a class="btn btn-labeled btn-default" href="{{ route('admin.users.edit', $user->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('admin/users.edit') }}</a>

          @endpermission

          @permission('delete_user')

          <button type="button" data-destroy="data-destroy" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('admin/users.delete') }}</button>

          @endpermission

        {!! Form::close() !!}
      </td>
    </tr>
  @endforeach
</table>

{{ $users->appends(Request::except('page'))->links() }}

<div class="text-center">

</div>
@endsection
