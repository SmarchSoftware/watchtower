@extends(config('watchtower.views.layouts.master'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-1x fa-fw fa-envelope"></i></div>
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-1x fa-fw fa-lock"></i></div>
                                <input type="password" class="form-control" name="password">
                                {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-1x fa-fw fa-lock"></i></div>
                                <input type="password" class="form-control" name="password_confirmation">
                                {!! $errors->first('password_confirmation', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection