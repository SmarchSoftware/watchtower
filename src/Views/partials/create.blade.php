@extends('watchtower::layouts.master')

@section('content')

  @if ( \Shinobi::can( config('watchtower.acl.'.$route.'.create', false) ) )

    <h1>Create New {{ $route }}</h1>
    <hr/>

    {!! Form::open( ['route' => 'watchtower.'.$route.'.store', 'class' => 'form-horizontal']) !!}
    
    <div class="form-group">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('name', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    <div class="form-group">
        {!! Form::label('slug', 'Slug: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('slug', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('slug', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
        {!! $errors->first('description', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>

    @if ($route == "role")
    <div class="form-group">
        {!! Form::label('special', 'Special Access: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('special', array('all-access' => 'All Access', 'no-access' => 'No Access'), null, ['placeholder' => 'No special access.', 'class' => 'form-control'] ) !!}
        </div>
        {!! $errors->first('special', '<div class="col-sm-6 col-sm-offset-3 text-danger">:message</div>') !!}
    </div>
    @endif

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::hidden('tbl', $tbl) !!}
            {!! Form::submit('Create '.$route, ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
    {!! Form::close() !!}

  @else

      <div class="alert alert-danger lead">
        <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to create new {{$route}}s.
      </div>

    @endif

@endsection