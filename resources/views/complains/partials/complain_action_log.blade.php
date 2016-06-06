{{--action history--}}

<div class="row">

    @foreach($complain_actions as $key => $complain_action)

        @if ($key==0)

            <div class="col-md-12">

                <div class="panel panel-primary">

                    <?php

                    $label = 'Maklumbalas Terkini Pengadu';


                    if(!empty($complain_action->action_by)){

                        $label = 'Tindakan ICT Helpdesk / Teknikal';

                    }

                    ?>

                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $label }}</h3>
                    </div>


                    <div class="panel-body">

                        <form class="form-horizontal">


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tarikh </label>
                            <div class="col-sm-2">
                                <p class="form-control-static">{{ $complain_action->created_at->format('m/d/Y') }}</p>
                            </div>
                            <label class="col-sm-2 control-label">Masa </label>
                            <div class="col-sm-2">
                                <p class="form-control-static">{{ $complain_action->created_at->format('m/d/Y') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">Status</label>
                            <div class="col-sm-3 col-xs-10">

                                {{ $complain_action->complain_status->description }}

                            </div>
                        </div>

                         <?php if(!empty($complain_action->action_by)){ ?>

                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Tindakan </label>
                                <div class="col-sm-6 col-xs-10">
                                    {{ $complain_action->action_comment }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Sebab Lewat</label>
                                <div class="col-sm-6 col-xs-10">
                                    {{ $complain_action->delay_reason }}
                                </div>
                            </div>

                        <?php } else { ?>

                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Tindakan </label>
                                <div class="col-sm-6 col-xs-10">
                                    {{ $complain_action->user_comment }}
                                </div>
                            </div>

                        <?php } ?>

                        </form>

                    </div>

                </div>


            </div>

        @else

            <div class="col-md-10 col-md-push-2">

                @if(empty($complain_action->user_emp_id) || is_null($complain_action->user_emp_id))

                    <div class="panel panel-warning">

                        <div class="panel-heading">
                            <h3 class="panel-title">Maklumbalas ICT Helpdesk / Teknikal</h3>
                        </div>

                        <div class="panel-body">

                            <form class="form-horizontal">

                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Tindakan Oleh:</label>
                                <div class="col-sm-3 col-xs-10">
                                    {{ $complain_action->user->name }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tarikh </label>
                                <div class="col-sm-2">
                                    <p class="form-control-static">{{ $complain_action->created_at->format('m/d/Y') }}</p>
                                </div>
                                <label class="col-sm-2 control-label">Masa </label>
                                <div class="col-sm-2">
                                    <p class="form-control-static">{{ $complain_action->created_at->format('H:i:s') }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Status</label>
                                <div class="col-sm-3 col-xs-10">

                                    {{ $complain_action->complain_status->description }}

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Tindakan </label>
                                <div class="col-sm-6 col-xs-10">
                                    {{ $complain_action->action_comment }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Sebab Lewat</label>
                                <div class="col-sm-6 col-xs-10">
                                    {{ $complain_action->delay_reason }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">


                                </div>
                            </div>

                            </form>

                        </div>
                    </div>

                @else

                    <div class="panel panel-info">

                        <div class="panel-heading">
                            <h3 class="panel-title">Maklumbalas Pengguna</h3>
                        </div>

                        <div class="panel-body">

                            <form class="form-horizontal">

                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Maklumbalas Oleh:</label>
                                <div class="col-sm-3 col-xs-10">
                                    {{ $complain_action->complain_user->name }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tarikh </label>
                                <div class="col-sm-2">
                                    <p class="form-control-static">{{ $complain_action->created_at->format('m/d/Y') }}</p>
                                </div>
                                <label class="col-sm-2 control-label">Masa </label>
                                <div class="col-sm-2">
                                    <p class="form-control-static">{{ $complain_action->created_at->format('H:i:s') }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-xs-12 control-label">Komen Pengguna </label>
                                <div class="col-sm-6 col-xs-10">
                                    {{ $complain_action->user_comment }}
                                </div>
                            </div>

                            </form>

                        </div>

                    </div>


                @endif

            </div>

        @endif



    @endforeach

</div>