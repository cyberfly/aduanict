@extends('layouts.app')

@section('content_filter')

<div class="panel panel-info">
  <div class="panel-heading">Filter</div>
  <div class="panel-body">

        {!! Form::open(array('route' => 'admin.roles.index', 'method'=>'GET')) !!}

            <div class="row">
              <div class="col-lg-4">
                {!! Form::text('name',Request::get('name'),array('class'=>'form-control','placeholder'=>'Enter Name')) !!}
              </div>
              <div class="col-lg-4">
                {!! Form::submit(trans('admin/roles.search-role'),array('class'=>'btn btn-primary')) !!}
              </div>
            </div>

        {!! Form::close() !!}


  </div>
</div>


@endsection

@section('heading', 'Roles')

@section('content')
<div class="models-actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('admin.roles.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('admin/roles.create-role') }}</a>
</div>
<table class="table table-bordered table-striped table-hover">
  <tr>
    <th>Display Name</th>
    <th>Name</th>
    <th>Role Can</th>
    <th>Actions</th>
  </tr>
  @foreach($roles as $role)
    <tr>
      <td>{{ $role->display_name }}</td>
      <td>{{ $role->name }}</td>
      <td>
          @if($role->perms)

          @foreach($role->perms as $permission)
              <code> {{ $permission->display_name }} </code>
              <br>
          @endforeach

          @endif
      </td>
      <td class="col-xs-3">

        {!! Form::open(['data-remote','route' => ['admin.roles.destroy',$role->id], 'method' => 'DELETE']) !!}

          @permission('edit_role')

          <a class="btn btn-labeled btn-default" href="{{ route('admin.roles.edit', $role->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('admin/roles.edit') }}</a>

          @endpermission

          @permission('delete_role')

          <button type="button" data-destroy="data-destroy" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('admin/roles.delete') }}</button>

          @endpermission

        {!! Form::close() !!}
      </td>
    </tr>
  @endforeach
</table>

{{ $roles->appends(Request::except('page'))->links() }}

<div class="text-center">

</div>
@endsection
