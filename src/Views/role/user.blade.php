@extends('watchtower::layouts.master')

@section('content')

  @if ( \Shinobi::can( config('watchtower.acl.role.users', false) ) )

  <h1>'{{ $role->name }}' Users</h1>
  <hr/>

  {!! Form::model($role, [ 'route' => [ 'watchtower.role.user.update', $role->id ], 'class' => 'form-horizontal']) !!}
  {!! Form::hidden('id', $role->id) !!}

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <i class="icon-calendar"></i>
          <h2 class="panel-title">Current Users <small>({{$users->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @foreach($users->chunk(6) as $c)
            @foreach ($c as $u)
            <div class="col-md-2 col-sm-3 col-xs-4">
            <label class="checkbox-inline" title="{{ $u->slug }}">
              <input type="checkbox" name="slug[]" value="{{$u->id}}" checked=""> {{ $u->name }}
            </label>
            </div>
            @endforeach
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <i class="icon-calendar"></i>
          <h2 class="panel-title">Available Users <small>({{$available_users->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @foreach($available_users->chunk(6) as $chunk)
            @foreach ($chunk as $au)
            <div class="col-md-2 col-sm-3 col-xs-4">
            <label class="checkbox-inline" title="{{ $au->slug }}">
              <input type="checkbox" name="slug[]" value="{{$au->id}}"> {{ $au->name }}
            </label>
            </div>
            @endforeach
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
      <div class="col-sm-3">
          {!! Form::submit('Update Users', ['class' => 'btn btn-primary form-control']) !!}
      </div>    
  </div>

  {!! Form::close() !!}

  @else

      <div class="alert alert-danger lead">
        <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to sync role users.
      </div>

  @endif

@endsection