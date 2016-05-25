@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="center-block">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body ">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="username" class=" col-sm-4  col-xs-12 control-label">Username</label>
                                    <div class="col-sm-6 ">
                                        <input type="username" class="form-control" id="username" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-4  col-xs-12 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8 ">
                                        <a href="home.html" type="submit" class="btn btn-primary btn-block">Sign in</a>
                                    </div>
                                </div>
                            </form>
                    </div>
                    </div>
                </div>
        </div>
    </div>

    @endsection
