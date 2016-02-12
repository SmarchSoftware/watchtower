@extends(config('watchtower.views.layouts.master'))

@section('content')

  <h1>'{{ $permission->name }}' Roles</h1>
  <hr/>

  {!! Form::model($permission, [ 'route' => [ config('watchtower.route.as') .'permission.role.update', $permission->id ], 'class' => 'form-horizontal']) !!}

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <h2 class="panel-title"><i class="fa fa-users fa-lg"></i> Current Roles <small>({{$roles->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @forelse($roles->chunk(6) as $c)
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
          @empty
            <span class="text-warning"><i class="fa fa-warning text-warning"></i> This permission does not have any defined roles.</span>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <h2 class="panel-title"><i class="fa fa-users"></i> Available Roles <small>({{$available_roles->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @forelse($available_roles->chunk(6) as $chunk)
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
          @empty
            <span class="text-danger"><i class="fa fa-warning text-danger"></i> There aren't any available roles.</span>
          @endforelse
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

@endsection