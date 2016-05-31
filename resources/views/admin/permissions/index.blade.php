@extends('admin.app')

@section('content_filter')

<div class="panel panel-info">
  <div class="panel-heading">Filter</div>
  <div class="panel-body">

        {!! Form::open(array('route' => 'admin.permissions.index', 'method'=>'GET')) !!}

            <div class="row">
              <div class="col-md-4">
                {!! Form::text('name',Request::get('name'),array('class'=>'form-control','placeholder'=>'Enter Name')) !!}
              </div>
              <div class="col-md-4">
                {!! Form::submit('Cari Kebenaran',array('class'=>'btn btn-primary')) !!}
              </div>
            </div>

        {!! Form::close() !!}


  </div>
</div>


@endsection

@section('content')

    <h3 class="">Pengurusan Kebenaran</h3>

<div class="models-actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('admin.permissions.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah Kebenaran</a>
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

          <a class="btn btn-labeled btn-default" href="{{ route('admin.permissions.edit', $permission->id) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Kemaskini</a>

          @endpermission

          @permission('delete_permission')

          <button type="button" data-destroy="data-destroy" class="btn btn-labeled btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button>

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
