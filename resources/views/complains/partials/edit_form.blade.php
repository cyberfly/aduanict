{!! Form::open(array('route' => ['complain.update',$complain->complain_id],'method'=>'put','class'=>"form-horizontal")) !!}

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
            <label class="col-sm-2 col-xs-12 control-label">Kategori <span class="symbol"> * </span> </label>
            <div class="col-sm-3 col-xs-10">

                {{--Kalau TEKNIKAL EDIT FORM, paparkan nama kategori sahaja, dan ada hidden field exclude_category--}}

                @if(!empty($exclude_category) && $exclude_category!='Y')

                {!! Form::select('complain_category_id', $complain_categories, $complain->complain_category_id.'-'.$complain->unit_id, ['class' => 'form-control chosen', 'id'=>'complain_category_id']); !!}

                @else

                    {{ $complain->complain_category->description }}

                    <input type="hidden" name="exclude_category" value="Y">

                @endif

            </div>

        </div>

        @if($hide_branches_assets_locations=='N')

        <div class="form-group hide_by_category  {{ $errors->has('branch_id') ? 'has-error' : false }} ">
            <label class="col-sm-2 control-label">Cawangan <span class="symbol"> * </span></label>
            <div class="col-sm-6">
                <div class="input-group">

                    @if(Entrust::hasRole('members'))

                        @if($complain->assets_location)

                        <p id="branch_name">{{ $complain->assets_location->branch->branch_description }}</p>
                        <input type="hidden" name="branch_id" id="branch_id" value="{{ $complain->branch_id }}">

                        @endif

                    @else

                        {!! Form::select('branch_id', $branches, $complain->branch_id, ['class' => 'form-control chosen', 'id'=>'branch_id']); !!}

                    @endif

                </div><!-- /input-group -->
            </div>
        </div>

        <div class="form-group hide_by_category  {{ $errors->has('lokasi_id') ? 'has-error' : false }} ">
            <label class="col-sm-2 control-label">Lokasi <span class="symbol"> * </span></label>
            <div class="col-sm-6">
                <div class="input-group">

                    {!! Form::select('lokasi_id', $locations, $complain->lokasi_id, ['class' => 'form-control chosen', 'id'=>'lokasi_id']); !!}

                </div><!-- /input-group -->
            </div>
        </div>
        <div class="form-group hide_by_category  {{ $errors->has('ict_no') ? 'has-error' : false }} ">
            <label class="col-sm-2 control-label">Aset <span class="symbol"> * </span></label>
            <div class="col-sm-6">
                <div class="input-group">

                    {!! Form::select('ict_no', $assets, $complain->ict_no, ['class' => 'form-control', 'id'=>'ict_no']); !!}

                </div><!-- /input-group -->
            </div>
        </div>

        @else
            {{--bila tak papar branch, lokasi dan asset, kita ganti hidden--}}
            {{--hidden untuk bagitau validation exclude this 3 guy--}}
            <input type="hidden" name="exclude_branch_asset" value="Y">

        @endif

        <div class="form-group  {{ $errors->has('complain_source_id') ? 'has-error' : false }} ">
            <label class="col-sm-2 control-label">Kaedah </label>
            <div class="col-sm-3">

                {{ $complain->complain_source->description }}

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Aduan</label>
            <div class="col-sm-6">
                <p class="form-control-static">{{ $complain->complain_description }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Fail Attachment</label>
            <div class="col-sm-10">

                <div class="row">

                @foreach($complain->attachments as $attachment)
                <?php
                    $img_extension = ['png','jpg','bmp','gif','jpeg'];
                    $extension = File::extension($attachment->attachment_filename);
                ?>
                    @if(in_array($extension,$img_extension))

                        <div class="col-xs-6 col-md-3">

                            <a href="{{ url('uploads/'.$attachment->attachment_filename) }}" class="thumbnail">
                                <img src="{{ url('uploads/'.$attachment->attachment_filename) }}" alt="">
                            </a>

                        </div>
                            @else
                        <p><a href="{{ url('uploads/'.$attachment->attachment_filename) }}">{{ $attachment->attachment_filename }}</a></p>
                    @endif

                @endforeach

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Hantar</button>
                <a href="{{ route('complain.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </div>
</div>
<!--end-->

{!! Form::close() !!}