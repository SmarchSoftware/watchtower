@extends('watchtower::layouts.master')

@section('content')

  @if ( \Shinobi::can( config('watchtower.acl.permission.role', false) ) )

  <h1>'{{ $permission->name }}' Roles</h1>
  <hr/>

  {!! Form::model($permission, [ 'route' => [ 'watchtower.permission.role.update', $permission->id ], 'class' => 'form-horizontal']) !!}
  {!! Form::hidden('id', $permission->id) !!}

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <i class="icon-calendar"></i>
          <h2 class="panel-title">Current Roles <small>({{$roles->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @foreach($roles->chunk(6) as $c)
            @foreach ($c as $p)
            <div class="col-md-2 col-sm-3 col-xs-4">
            <label class="checkbox-inline" title="{{ $p->slug }}">
              <input type="checkbox" name="slug[]" value="{{$p->id}}" checked=""> {{ $p->name }}
              @if ($p->special == 'all-access')
                <i class="fa fa-star text-success"></i> 
              @elseif ($p->special == 'no-access')
                <i class="fa fa-ban text-danger"></i> 
              @endif
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
          <h2 class="panel-title">Available Roles <small>({{$available_roles->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @foreach($available_roles->chunk(6) as $chunk)
            @foreach ($chunk as $perm)
            <div class="col-md-2 col-sm-3 col-xs-4">
            <label class="checkbox-inline" title="{{ $perm->slug }}">
              <input type="checkbox" name="slug[]" value="{{$perm->id}}"> {{ $perm->name }}
              @if ($perm->special == 'all-access')
                <i class="fa fa-star text-success"></i> 
              @elseif ($perm->special == 'no-access')
                <i class="fa fa-ban text-danger"></i> 
              @endif
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
            {!! Form::submit('Update roles', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
  {!! Form::close() !!}

  @else

      <div class="alert alert-danger lead">
        <i class="fa fa-exclamation-triangle fa-1x"></i> You are not permitted to sync permission roles.
      </div>

  @endif

@endsection