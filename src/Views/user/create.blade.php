@extends('watchtower::layouts.master')

@section('content')

  @if ( \Shinobi::can( config('watchtower.acl.user.create', false) ) )

    <h1>Create New User</h1>
    <hr/>

    {!! Form::open( ['route' => 'watchtower.user.store', 'class' => 'form-horizontal']) !!}
    
    <div class="form-group">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('name', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email Address: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('email', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-md-6">
            <input type="password" class="form-control" name="password">
            {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm Password: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation">
            {!! $errors->first('password_confirmation', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
    
    {!! Form::close() !!}

  @else

    <div class="alert alert-danger lead">
        <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to create new users.
    </div>

  @endif

@endsection