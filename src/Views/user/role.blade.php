@extends(config('watchtower.views.layouts.master'))

@section('content')

  <h1>'{{ $user->name }}' Roles</h1>
  <hr/>

  {!! Form::model($user, [ 'route' => [ 'watchtower.user.role.update', $user->id ], 'class' => 'form-horizontal']) !!}
  {!! Form::hidden('id', $user->id) !!}

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading clearfix">
          <i class="icon-calendar"></i>
          <h2 class="panel-title">Current Roles <small>({{$roles->count()}})</small></h2>
        </div>
        
        <div class="panel-body">
          @foreach($roles->chunk(6) as $c)
            @foreach ($c as $r)
            <div class="col-md-2 col-sm-3 col-xs-4">
            <label class="checkbox-inline" title="{{ $r->id }}">
              <input type="checkbox" name="ids[]" value="{{$r->id}}" checked=""> {{ $r->name }}
              @if ($r->special == 'all-access')
                <i class="fa fa-star text-success"></i> 
              @elseif ($r->special == 'no-access')
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
            @foreach ($chunk as $ar)
            <div class="col-md-2 col-sm-3 col-xs-4">
            <label class="checkbox-inline" title="{{ $ar->id }}">
              <input type="checkbox" name="ids[]" value="{{$ar->id}}"> {{ $ar->name }}
              @if ($ar->special == 'all-access')
                <i class="fa fa-star text-success"></i> 
              @elseif ($ar->special == 'no-access')
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
          {!! Form::submit('Update Roles', ['class' => 'btn btn-primary form-control']) !!}
      </div>
  </div>

  {!! Form::close() !!}

@endsection