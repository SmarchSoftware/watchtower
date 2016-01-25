@extends(config('watchtower.views.layouts.master'))

@section('content')

  <h1>'{{ $role->name }}' Permissions</h1>
  <hr/>

  {!! Form::model($role, [ 'route' => [ config('watchtower.route.as') .'role.permission.update', $role->id ], 'class' => 'form-horizontal']) !!}
  {!! Form::hidden('id', $role->id) !!}

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <h2 class="panel-title"><i class="fa fa-key fa-lg"></i> Current Permissions <small>({{$permissions->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @foreach($permissions->chunk(6) as $c)
            @foreach ($c as $p)
            <div class="col-md-2 col-sm-3 col-xs-4">
            <label class="checkbox-inline" title="{{ $p->slug }}">
              <input type="checkbox" name="slug[]" value="{{$p->id}}" checked=""> {{ $p->name }}
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
          <h2 class="panel-title"><i class="fa fa-key"></i> Available Permissions <small>({{$available_permissions->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @foreach($available_permissions->chunk(6) as $chunk)
            @foreach ($chunk as $perm)
            <div class="col-md-2 col-sm-3 col-xs-4">
            <label class="checkbox-inline" title="{{ $perm->slug }}">
              <input type="checkbox" name="slug[]" value="{{$perm->id}}"> {{ $perm->name }}
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
          {!! Form::submit('Sync Role Permissions', ['class' => 'btn btn-primary form-control']) !!}
      </div>    
  </div>

  {!! Form::close() !!}

@endsection