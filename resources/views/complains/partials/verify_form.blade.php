{!! Form::open(array('route' => ['complain.verify',$complain->complain_id],'method'=>'put','class'=>"form-horizontal")) !!}

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Maklumat Aduan</h3>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label">Tarikh </label>
            <div class="col-sm-2">
                <p class="form-control-static">{{  $complain->created_at->format('d/m/Y') }}</p>
            </div>
            <label class="col-sm-2 control-label">Masa </label>
            <div class="col-sm-2">
                <p class="form-control-static">{{  $complain->created_at->format('H:i:s') }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Pengadu </label>
            <div class="col-sm-2">
                <p class="form-control-static">{{ $complain->user->name }}</p>
            </div>
            <label class="col-sm-2 control-label">No. Pekerja </label>
            <div class="col-sm-2">
                <p class="form-control-static">{{ $complain->user->id }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Bagi Pihak</label>
            <div class="col-sm-2">
                <p class="form-control-static">- </p>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('complain_category_id') ? 'has-error' : false }} ">
            <label class="col-sm-2 col-xs-12 control-label">Kategori </label>
            <div class="col-sm-3 col-xs-10">



            </div>

        </div>

        <div class="form-group hide_by_category  {{ $errors->has('branch_id') ? 'has-error' : false }} ">
            <label class="col-sm-2 control-label">Cawangan </label>
            <div class="col-sm-6">
                <div class="input-group">


                </div><!-- /input-group -->
            </div>
        </div>

        <div class="form-group hide_by_category  {{ $errors->has('lokasi_id') ? 'has-error' : false }} ">
            <label class="col-sm-2 control-label">Lokasi </label>
            <div class="col-sm-6">
                <div class="input-group">


                </div><!-- /input-group -->
            </div>
        </div>
        <div class="form-group hide_by_category  {{ $errors->has('ict_no') ? 'has-error' : false }} ">
            <label class="col-sm-2 control-label">Aset </label>
            <div class="col-sm-6">
                <div class="input-group">


                </div><!-- /input-group -->
            </div>
        </div>
        <div class="form-group  {{ $errors->has('complain_source_id') ? 'has-error' : false }} ">
            <label class="col-sm-2 control-label">Kaedah</label>
            <div class="col-sm-3">


            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Aduan</label>
            <div class="col-sm-6">
                <p class="form-control-static">{{ $complain->complain_description }}</p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">

            </div>
        </div>
    </div>
</div>
<!--end-->

{!! Form::close() !!}