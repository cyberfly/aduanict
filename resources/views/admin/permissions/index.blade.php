@extends('layouts.app')

@section('content_filter')

<div class="panel panel-info">
  <div class="panel-heading">Filter</div>
  <div class="panel-body">

        {!! Form::open(array('route' => 'admin.permissions.index', 'method'=>'GET')) !!}

            <div class="row">
              <div class="col-lg-4">
                {!! Form::text('name',Request::get('name'),array('class'=>'form-control','placeholder'=>'Enter Name')) !!}
              </div>
              <div class="col-lg-4">
                {!! Form::submit(trans('admin/permissions.search-permission'),array('class'=>'btn btn-primary')) !!}
              </div>
            </div>

        {!! Form::close() !!}


  </div>
</div>


@endsection

@section('heading', 'Permissions')

@section('content')
<div class="models-actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('admin.permissions.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('admin/permissions.create-permission') }}</a>
</div>
<table class="table table-bordered table-striped table-hover">
  <tr>
    <th>Display Name</th>
    <th>Name</th>
    <th>Actions</th>
  </tr>
  @foreach($permissions as $permission)
    <tr>
      <td>{{ $permission->display_name }}</th>
      <td>{{ $permission->name }}</th>
      <td class="col-xs-3">

        {!! Form::open(['data-remote','route' => ['admin.permissions.destroy',$permission->id], 'method' => 'DELETE']) !!}

          @permission('edit_permission')

          <a class="btn btn-labeled btn-default" href="{{ route('admin.permissions.edit', $permission->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('admin/permissions.edit') }}</a>

          @endpermission

          @permission('delete_permission')

          <button type="button" data-destroy="data-destroy" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('admin/permissions.delete') }}</button>

          @endpermission

        {!! Form::close() !!}
      </td>
    </tr>
  @endforeach
</table>

{{ $permissions->appends(Request::except('page'))->links() }}

<div class="text-center">

</div>
@endsection
